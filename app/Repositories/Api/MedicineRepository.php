<?php

namespace App\Repositories\Api;

use App\Models\Medicine;
use App\Models\MedicineHistory;
use App\Models\MedicineScheduleException;
use App\Repositories\Admin\MedicineRepository as AdminMedicineRepository;
use Illuminate\Support\Facades\DB;

class MedicineRepository
{
    public function __construct(
        protected AdminMedicineRepository $medicineRepository
    ) {}

    public function getByUser(int $userId)
    {
        return Medicine::with([
            'schedule.days',
            'schedule.times',
        ])
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->oldest()
            ->get();
    }

    public function findByUser(
        int $medicineId,
        int $userId
    ) {
        return Medicine::with([
            'schedule.days',
            'schedule.times',
        ])
            ->where('id', $medicineId)
            ->where('user_id', $userId)
            ->first();
    }

    public function create(
        int $userId,
        array $data
    ) {
        $data['user_id'] = $userId;

        return $this->medicineRepository->create(
            $data
        );
    }

    public function update(
        Medicine $medicine,
        array $data
    ) {
        return $this->medicineRepository->update(
            $medicine,
            $data
        );
    }

    public function delete(
        Medicine $medicine
    ) {
        return $this->medicineRepository->delete(
            $medicine
        );
    }

    public function deletePermanent(
        Medicine $medicine
    ) {
        return $this->medicineRepository->deletePermanent(
            $medicine
        );
    }

    public function updateDose(
        Medicine $medicine,
        array $data
    ) {
        return DB::transaction(function () use (
            $medicine,
            $data
        ) {

            $schedule = $medicine->schedule;

            if (!$schedule) {
                throw new \RuntimeException(
                    'Jadwal obat tidak ditemukan.'
                );
            }

            $scheduleTime = $schedule
                ->times()
                ->where(
                    'id',
                    $data['schedule_time_id']
                )
                ->first();

            if (!$scheduleTime) {
                throw new \RuntimeException(
                    'Jadwal dosis tidak ditemukan.'
                );
            }

            MedicineScheduleException::updateOrCreate(
                [
                    'medicine_id' =>
                    $medicine->id,

                    'schedule_time_id' =>
                    $scheduleTime->id,

                    'scheduled_date' =>
                    $data['scheduled_date'],
                ],
                [
                    'action' =>
                    'updated',

                    'dosage' =>
                    $data['dosage'],

                    'dosage_unit' =>
                    $data['dosage_unit'],

                    'instruction' =>
                    $data['instruction']
                        ?? $medicine->instruction,

                    'reminder_time' =>
                    $data['reminder_time']
                        ?? $scheduleTime->reminder_time,
                ]
            );

            return $medicine->fresh([
                'schedule.days',
                'schedule.times',
            ]);
        });
    }

    public function deleteSingleDose(
        Medicine $medicine,
        int $scheduleTimeId,
        string $scheduledDate
    ) {
        return DB::transaction(function () use (
            $medicine,
            $scheduleTimeId,
            $scheduledDate
        ) {

            $schedule = $medicine->schedule;

            if (!$schedule) {
                throw new \RuntimeException(
                    'Jadwal obat tidak ditemukan.'
                );
            }

            $scheduleTime = $schedule
                ->times()
                ->where(
                    'id',
                    $scheduleTimeId
                )
                ->first();

            if (!$scheduleTime) {
                throw new \RuntimeException(
                    'Jadwal dosis tidak ditemukan.'
                );
            }

            MedicineScheduleException::updateOrCreate(
                [
                    'medicine_id' =>
                    $medicine->id,

                    'schedule_time_id' =>
                    $scheduleTime->id,

                    'scheduled_date' =>
                    $scheduledDate,
                ],
                [
                    'action' =>
                    'deleted',

                    'dosage' =>
                    null,

                    'dosage_unit' =>
                    null,

                    'instruction' =>
                    null,

                    'reminder_time' =>
                    null,
                ]
            );

            return true;
        });
    }
}
