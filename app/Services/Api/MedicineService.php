<?php

namespace App\Services\Api;

use App\Repositories\Api\MedicineRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MedicineService
{
    public function __construct(
        protected MedicineRepository $repository
    ) {}

    public function getByUser(int $userId)
    {
        return $this->repository->getByUser(
            $userId
        );
    }

    public function findByUser(
        int $medicineId,
        int $userId
    ) {
        return $this->repository->findByUser(
            $medicineId,
            $userId
        );
    }

    public function create(
        int $userId,
        array $data
    ) {
        $data['user_id'] = $userId;

        return $this->repository->create(
            $userId,
            $data
        );
    }

    public function updateByUser(
        int $medicineId,
        int $userId,
        array $data
    ) {
        $medicine = $this->repository->findByUser(
            $medicineId,
            $userId
        );

        if (!$medicine) {
            throw new ModelNotFoundException(
                'Obat tidak ditemukan.'
            );
        }

        return $this->repository->update(
            $medicine,
            $data
        );
    }

    public function deleteByUser(
        int $medicineId,
        int $userId
    ) {
        $medicine = $this->repository->findByUser(
            $medicineId,
            $userId
        );

        if (!$medicine) {
            throw new ModelNotFoundException(
                'Obat tidak ditemukan.'
            );
        }

        return $this->repository->delete(
            $medicine
        );
    }

    public function deletePermanentByUser(
        int $medicineId,
        int $userId
    ) {
        $medicine = $this->repository->findByUser(
            $medicineId,
            $userId
        );

        if (!$medicine) {
            throw new ModelNotFoundException(
                'Obat tidak ditemukan.'
            );
        }

        return $this->repository->deletePermanent(
            $medicine
        );
    }

    public function updateDoseByUser(
        int $medicineId,
        int $userId,
        array $data
    ) {
        $medicine = $this->repository->findByUser(
            $medicineId,
            $userId
        );

        if (!$medicine) {
            throw new ModelNotFoundException(
                'Obat tidak ditemukan.'
            );
        }

        return $this->repository->updateDose(
            $medicine,
            $data
        );
    }

    public function deleteSingleDose(
        int $medicineId,
        int $userId,
        int $scheduleTimeId,
        string $scheduledDate
    ) {
        $medicine = $this->repository->findByUser(
            $medicineId,
            $userId
        );

        if (!$medicine) {
            throw new ModelNotFoundException(
                'Obat tidak ditemukan.'
            );
        }

        return $this->repository->deleteSingleDose(
            $medicine,
            $scheduleTimeId,
            $scheduledDate
        );
    }
}
