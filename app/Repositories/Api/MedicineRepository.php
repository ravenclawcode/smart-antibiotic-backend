<?php

namespace App\Repositories\Api;

use App\Models\Medicine;
use App\Repositories\Admin\MedicineRepository as AdminMedicineRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MedicineRepository
{

    public function __construct(
        protected AdminMedicineRepository $medicineRepository
    ) {}

    public function getByUuid(
        string $uuid
    ) {
        return Medicine::with([
            'antibiotic.category',
            'schedule.days',
            'schedule.times'
        ])

            ->whereHas('user', function ($query) use ($uuid) {

                $query->where('uuid', $uuid);
            })

            ->latest()

            ->get();
    }

    public function findByUuid(
        int $medicineId,
        string $uuid
    ) {
        return Medicine::with([
            'antibiotic.category',
            'schedule.days',
            'schedule.times'
        ])

            ->where('id', $medicineId)

            ->whereHas('user', function ($query) use ($uuid) {

                $query->where('uuid', $uuid);
            })

            ->firstOrFail();
    }

    public function create(array $data)
    {
        $user = User::where(
            'uuid',
            $data['uuid']
        )->firstOrFail();

        $payload = $data;

        $payload['user_id'] = $user->id;

        unset($payload['uuid']);

        return $this->medicineRepository->create(
            $payload
        );
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
                'antibiotic_id' => $data['antibiotic_id'],
                'dosage' => $data['dosage'],
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
                'antibiotic.category',
                'schedule.days',
                'schedule.times'
            ]);
        });
    }

    public function delete(
        Medicine $medicine
    ) {
        return DB::transaction(function () use (
            $medicine
        ) {

            $schedule = $medicine->schedule;

            if ($schedule) {
                $schedule->days()->delete();
                $schedule->times()->delete();
                $schedule->delete();
            }

            $medicine->delete();

            return true;
        });
    }
}
