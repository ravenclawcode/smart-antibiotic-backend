<?php

namespace App\Repositories\Admin;

use App\Models\Medicine;
use App\Models\MedicineSchedule;
use Illuminate\Support\Facades\DB;

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
                    $data['end_date'],

                    'is_active' => true,
                ]);

                $schedule =
                    MedicineSchedule::create([
                        'medicine_id' =>
                        $medicine->id,

                        'frequency_type' =>
                        $data['frequency_type'],

                        'times_per_day' =>
                        $data['times_per_day'] ?? null,

                        'interval_value' =>
                        $data['interval_value'] ?? null,
                    ]);

                /*
                |--------------------------------------------------------------------------
                | DAYS
                |--------------------------------------------------------------------------
                |
                | schedule_days.value digunakan untuk:
                |
                | certain_days  -> 1-7
                | interval_weeks -> 1-7
                |
                */

                if (
                    !empty($data['days'])
                ) {
                    foreach (
                        $data['days']
                        as $day
                    ) {
                        $schedule
                            ->days()
                            ->create([
                                'value' => $day,
                            ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | DATES
                |--------------------------------------------------------------------------
                |
                | Untuk interval_months:
                | schedule_days.value digunakan sebagai
                | tanggal dalam bulan 1-31.
                |
                */

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

                /*
                |--------------------------------------------------------------------------
                | TIMES
                |--------------------------------------------------------------------------
                */

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

                $schedule =
                    $medicine->schedule;

                if (!$schedule) {
                    $schedule =
                        MedicineSchedule::create([
                            'medicine_id' =>
                            $medicine->id,

                            'frequency_type' =>
                            $data['frequency_type'],

                            'times_per_day' =>
                            $data['times_per_day'] ?? null,

                            'interval_value' =>
                            $data['interval_value'] ?? null,
                        ]);
                } else {
                    $schedule->update([
                        'frequency_type' =>
                        $data['frequency_type'],

                        'times_per_day' =>
                        $data['times_per_day'] ?? null,

                        'interval_value' =>
                        $data['interval_value'] ?? null,
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | Hapus schedule lama
                |--------------------------------------------------------------------------
                */

                $schedule
                    ->days()
                    ->delete();

                $schedule
                    ->times()
                    ->delete();

                /*
                |--------------------------------------------------------------------------
                | DAYS
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | DATES
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | TIMES
                |--------------------------------------------------------------------------
                */

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

    public function delete(
        Medicine $medicine
    ) {
        return DB::transaction(
            function () use ($medicine) {

                $schedule =
                    $medicine->schedule;

                if ($schedule) {

                    $schedule
                        ->days()
                        ->delete();

                    $schedule
                        ->times()
                        ->delete();

                    $schedule->delete();
                }

                return $medicine->delete();
            }
        );
    }
}
