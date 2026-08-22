<?php

namespace App\Repositories\Admin;

use App\Models\Medicine;
use App\Models\MedicineSchedule;
use Illuminate\Support\Facades\DB;
use App\Models\MedicineHistory;
use App\Models\MedicineScheduleException;

class MedicineRepository
{
    public function getAll()
    {
        return Medicine::with([
            'user',
            'schedule.days',
            'schedule.times',
        ])
            ->oldest()
            ->get();
    }

    public function getByUser(int $userId)
    {
        return Medicine::with([
            'schedule.days',
            'schedule.times',
        ])
            ->where(
                'user_id',
                $userId
            )
            ->orderBy(
                'is_active',
                'desc'
            )
            ->orderBy(
                'start_date'
            )
            ->get();
    }

    public function find(int $id)
    {
        return Medicine::with([
            'user',
            'schedule.days',
            'schedule.times.histories',
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(
            function () use ($data) {

                $medicine = Medicine::create([
                    'user_id' =>
                    $data['user_id'],

                    'name' =>
                    $data['name'],

                    'dosage' =>
                    $data['dosage'],

                    'dosage_unit' =>
                    $data['dosage_unit'],

                    'instruction' =>
                    $data['instruction'] ?? null,

                    'start_date' =>
                    $data['start_date'],

                    'end_date' =>
                    $data['end_date'] ?? null,

                    'is_active' => true,
                ]);

                $schedule = MedicineSchedule::create([
                    'medicine_id' =>
                    $medicine->id,

                    'frequency_type' =>
                    $data['frequency_type'],

                    'times_per_day' =>
                    $data['times_per_day']
                        ?? count($data['times'] ?? [])
                        ?: 1,

                    'interval_value' =>
                    $data['interval_value'] ?? null,
                ]);

                if (
                    in_array(
                        $data['frequency_type'],
                        [
                            'certain_days',
                            'interval_weeks',
                        ],
                        true
                    )
                ) {
                    foreach (
                        $data['days'] ?? []
                        as $day
                    ) {
                        $schedule
                            ->days()
                            ->create([
                                'value' => $day,
                            ]);
                    }
                }

                if (
                    $data['frequency_type'] ===
                    'interval_months'
                ) {
                    foreach (
                        $data['dates'] ?? []
                        as $date
                    ) {
                        $schedule
                            ->days()
                            ->create([
                                'value' => $date,
                            ]);
                    }
                }

                foreach (
                    $data['times'] ?? []
                    as $time
                ) {
                    $schedule
                        ->times()
                        ->create([
                            'reminder_time' =>
                            $time,
                        ]);
                }

                return $medicine->load([
                    'schedule.days',
                    'schedule.times',
                ]);
            }
        );
    }

    public function update(
        Medicine $medicine,
        array $data
    ) {
        return DB::transaction(
            function () use (
                $medicine,
                $data
            ) {

                $medicine->update([
                    'name' =>
                    $data['name'],

                    'dosage' =>
                    $data['dosage'],

                    'dosage_unit' =>
                    $data['dosage_unit'],

                    'instruction' =>
                    $data['instruction'] ?? null,

                    'start_date' =>
                    $data['start_date'],

                    'end_date' =>
                    $data['end_date'] ?? null,
                ]);

                $schedule = $medicine->schedule;

                if (!$schedule) {

                    $schedule = MedicineSchedule::create([
                        'medicine_id' =>
                        $medicine->id,

                        'frequency_type' =>
                        $data['frequency_type'],

                        'times_per_day' =>
                        $data['times_per_day']
                            ?? count($data['times'] ?? [])
                            ?: 1,

                        'interval_value' =>
                        $data['interval_value'] ?? null,
                    ]);
                } else {

                    $schedule->update([
                        'frequency_type' =>
                        $data['frequency_type'],

                        'times_per_day' =>
                        $data['times_per_day']
                            ?? count($data['times'] ?? [])
                            ?: 1,

                        'interval_value' =>
                        $data['interval_value'] ?? null,
                    ]);
                }

                $schedule
                    ->days()
                    ->delete();

                if (
                    in_array(
                        $data['frequency_type'],
                        [
                            'certain_days',
                            'interval_weeks',
                        ],
                        true
                    )
                ) {
                    foreach (
                        $data['days'] ?? []
                        as $day
                    ) {
                        $schedule
                            ->days()
                            ->create([
                                'value' => $day,
                            ]);
                    }
                }

                if (
                    $data['frequency_type'] ===
                    'interval_months'
                ) {
                    foreach (
                        $data['dates'] ?? []
                        as $date
                    ) {
                        $schedule
                            ->days()
                            ->create([
                                'value' => $date,
                            ]);
                    }
                }

                $existingTimes = $schedule
                    ->times()
                    ->orderBy('id')
                    ->get();

                $newTimes = array_values(
                    $data['times'] ?? []
                );

                $existingCount = $existingTimes->count();
                $newCount = count($newTimes);

                $commonCount = min(
                    $existingCount,
                    $newCount
                );

                for (
                    $i = 0;
                    $i < $commonCount;
                    $i++
                ) {
                    $existingTimes[$i]->update([
                        'reminder_time' =>
                        $newTimes[$i],
                    ]);
                }

                if ($newCount > $existingCount) {

                    for (
                        $i = $existingCount;
                        $i < $newCount;
                        $i++
                    ) {
                        $schedule
                            ->times()
                            ->create([
                                'reminder_time' =>
                                $newTimes[$i],
                            ]);
                    }
                }

                if ($existingCount > $newCount) {

                    for (
                        $i = $newCount;
                        $i < $existingCount;
                        $i++
                    ) {
                        $scheduleTime =
                            $existingTimes[$i];

                        $hasHistory =
                            MedicineHistory::where(
                                'schedule_time_id',
                                $scheduleTime->id
                            )->exists();

                        if (!$hasHistory) {

                            MedicineScheduleException::where(
                                'medicine_id',
                                $medicine->id
                            )
                                ->where(
                                    'schedule_time_id',
                                    $scheduleTime->id
                                )
                                ->delete();

                            $scheduleTime->delete();
                        } else {

                            MedicineScheduleException::where(
                                'medicine_id',
                                $medicine->id
                            )
                                ->where(
                                    'schedule_time_id',
                                    $scheduleTime->id
                                )
                                ->whereNull('scheduled_date')
                                ->delete();
                        }
                    }
                }

                return $medicine->fresh([
                    'schedule.days',
                    'schedule.times',
                ]);
            }
        );
    }

    public function delete(
        Medicine $medicine
    ) {
        return DB::transaction(
            function () use ($medicine) {

                $medicine->update([
                    'is_active' => false,
                ]);

                return $medicine->fresh([
                    'schedule.days',
                    'schedule.times',
                ]);
            }
        );
    }

    public function deletePermanent(
        Medicine $medicine
    ) {
        return DB::transaction(
            function () use ($medicine) {

                $schedule = $medicine->schedule;

                if ($schedule) {

                    $scheduleTimeIds =
                        $schedule
                        ->times()
                        ->pluck('id');

                    if (
                        $scheduleTimeIds->isNotEmpty()
                    ) {
                        MedicineHistory::whereIn(
                            'schedule_time_id',
                            $scheduleTimeIds
                        )->delete();
                    }

                    MedicineScheduleException::where(
                        'medicine_id',
                        $medicine->id
                    )->delete();

                    $schedule
                        ->days()
                        ->delete();

                    $schedule
                        ->times()
                        ->delete();

                    $schedule->delete();
                } else {

                    MedicineScheduleException::where(
                        'medicine_id',
                        $medicine->id
                    )->delete();
                }

                return $medicine->delete();
            }
        );
    }
}
