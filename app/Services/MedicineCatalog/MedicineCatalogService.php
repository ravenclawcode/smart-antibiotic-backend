<?php

namespace App\Services\MedicineCatalog;

use App\Models\MedicineCatalog;
use App\Repositories\MedicineCatalog\MedicineCatalogRepository;

class MedicineCatalogService
{
    public function __construct(
        protected MedicineCatalogRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {

            $data['image'] = $data['image']->store(
                'medicine_catalog',
                'public'
            );

        }

        return $this->repository->create($data);
    }

    public function update(
        MedicineCatalog $medicine,
        array $data
    ) {

        if (isset($data['image'])) {

            $data['image'] = $data['image']->store(
                'medicine_catalog',
                'public'
            );

        }

        return $this->repository->update(
            $medicine,
            $data
        );
    }

    public function delete(MedicineCatalog $medicine)
    {
        return $this->repository->delete($medicine);
    }
}