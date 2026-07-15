<?php

namespace App\Services\Admin;

use App\Models\Medicine;
use App\Repositories\Admin\MedicineRepository;

class MedicineService
{
    public function __construct(
        protected MedicineRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getByUser(int $userId)
    {
        return $this->repository->getByUser($userId);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function delete(Medicine $medicine)
    {
        return $this->repository->delete($medicine);
    }
}