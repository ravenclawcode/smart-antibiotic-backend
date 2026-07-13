<?php

namespace App\Repositories\Medicine;

use App\Models\Medicine;
use App\Models\MedicineSchedule;
use Illuminate\Support\Facades\DB;

class MedicineRepository
{
    public function getAll()
    {
        return Medicine::with([
            'user',
            'antibiotic',
            'schedule.days',
            'schedule.times'
        ])
            ->latest()
            ->get();
    }

    public function getByUser(int $userId)
    {
        return Medicine::with([
            'antibiotic',
            'schedule.days',
            'schedule.times'
        ])
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function find(int $id)
    {
        return Medicine::with([
            'user',
            'antibiotic.category',
            'schedule.days',
            'schedule.times.histories'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $medicine = Medicine::create([
                'user_id'       => $data['user_id'],
                'antibiotic_id' => $data['antibiotic_id'],
                'dosage'        => $data['dosage'],
                'instruction'   => $data['instruction'] ?? null,
                'start_date'    => $data['start_date'],
                'end_date'      => $data['end_date'],
                'is_active'     => true,
            ]);

            $schedule = MedicineSchedule::create([
                'medicine_id'    => $medicine->id,
                'frequency_type' => $data['frequency_type'],
                'times_per_day'  => $data['times_per_day'],
                'interval_value' => $data['interval_value'],
            ]);

            if (!empty($data['days'])) {

                foreach ($data['days'] as $day) {

                    $schedule->days()->create([
                        'day_of_week' => $day
                    ]);
                }
            }

            foreach ($data['times'] as $time) {

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
