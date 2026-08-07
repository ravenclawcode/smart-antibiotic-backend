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
            'catalog',
            'schedule.days',
            'schedule.times'
        ])
            ->oldest()
            ->get();
    }

    public function getByUser(int $userId)
    {
        return Medicine::with([
            'catalog',
            'schedule.days',
            'schedule.times'
        ])
            ->where('user_id', $userId)
            ->orderBy('is_active', 'desc')
            ->orderBy('start_date')
            ->get();
    }

    public function find(int $id)
    {
        return Medicine::with([
            'user',
            'catalog',
            'schedule.days',
            'schedule.times.histories'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $medicine = Medicine::create([
                'user_id' => $data['user_id'],
                'medicine_catalog_id' => $data['medicine_catalog_id'],
                'dosage' => $data['dosage'],
                'dosage_unit' => $data['dosage_unit'],
                'instruction' => $data['instruction'] ?? null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'is_active' => true,
            ]);

            $schedule = MedicineSchedule::create([
                'medicine_id'    => $medicine->id,
                'frequency_type' => $data['frequency_type'],
                'times_per_day'  => $data['times_per_day'] ?? null,
                'interval_value' => $data['interval_value'] ?? null,
            ]);

            if (!empty($data['days'])) {

                foreach ($data['days'] as $day) {

                    $schedule->days()->create([

                        'value' => $day

                    ]);
                }
            }

            if (!empty($data['dates'])) {

                foreach ($data['dates'] as $date) {

                    $schedule->days()->create([

                        'value' => $date

                    ]);
                }
            }

            foreach ($data['times'] ?? [] as $time) {

                $schedule->times()->create([
                    'reminder_time' => $time
                ]);
            }

            return $medicine->load([
                'schedule.days',
                'schedule.times'
            ]);
        });
    }

    public function update(
        Medicine $medicine,
        array $data
    ) {
        return DB::transaction(function () use (
            $medicine,
            $data
        ) {

            $medicine->update([
                'medicine_catalog_id' => $data['medicine_catalog_id'],
                'dosage' => $data['dosage'],
                'dosage_unit' => $data['dosage_unit'],
                'instruction' => $data['instruction'] ?? null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
            ]);

            $schedule = $medicine->schedule;

            $schedule->update([
                'frequency_type' => $data['frequency_type'],
                'times_per_day' => $data['times_per_day'],
                'interval_value' => $data['interval_value'] ?? null
            ]);

            $schedule->days()->delete();

            $schedule->times()->delete();

            if (!empty($data['days'])) {

                foreach ($data['days'] as $day) {

                    $schedule->days()->create([

                        'value' => $day

                    ]);
                }
            }

            if (!empty($data['dates'])) {

                foreach ($data['dates'] as $date) {

                    $schedule->days()->create([

                        'value' => $date

                    ]);
                }
            }

            foreach ($data['times'] as $time) {

                $schedule->times()->create([

                    'reminder_time' => $time

                ]);
            }

            return $medicine->load([

                'catalog',

                'schedule.days',

                'schedule.times'

            ]);
        });
    }

    public function delete(Medicine $medicine)
    {
        return DB::transaction(function () use ($medicine) {

            $schedule = $medicine->schedule;

            if ($schedule) {
                $schedule->days()->delete();
                $schedule->times()->delete();
                $schedule->delete();
            }
            return $medicine->delete();
        });
    }
}
