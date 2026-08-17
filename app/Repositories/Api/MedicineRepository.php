<?php

namespace App\Repositories\Api;

use App\Models\Medicine;
use App\Repositories\Admin\MedicineRepository as AdminMedicineRepository;

class MedicineRepository
{
    public function __construct(
        protected AdminMedicineRepository $medicineRepository
    ) {}

    public function getByUser(
        int $userId
    ) {
        return Medicine::with([
            'schedule.days',
            'schedule.times',
        ])
            ->where(
                'user_id',
                $userId
            )
            ->latest()
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
            ->where(
                'id',
                $medicineId
            )
            ->where(
                'user_id',
                $userId
            )
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
}
