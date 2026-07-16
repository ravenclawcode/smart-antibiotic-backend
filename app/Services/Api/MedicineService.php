<?php

namespace App\Services\Api;

use App\Repositories\Api\MedicineRepository;

class MedicineService
{
    public function __construct(
        protected MedicineRepository $repository
    ) {}

    public function getByUuid(
        string $uuid
    ) {
        return $this->repository->getByUuid(
            $uuid
        );
    }

    public function findByUuid(
        int $medicineId,
        string $uuid
    ) {
        return $this->repository->findByUuid(
            $medicineId,
            $uuid
        );
    }

    public function create(array $data)
    {
        return $this->repository->create(
            $data
        );
    }

    public function updateByUuid(
        int $medicineId,
        string $uuid,
        array $data
    ) {
        $medicine = $this->repository->findByUuid(
            $medicineId,
            $uuid
        );

        return $this->repository->update(
            $medicine,
            $data
        );
    }

    public function deleteByUuid(
        int $medicineId,
        string $uuid
    ) {
        $medicine = $this->repository->findByUuid(
            $medicineId,
            $uuid
        );

        return $this->repository->delete(
            $medicine
        );
    }
}
