<?php

namespace App\Services\Api;

use App\Repositories\Api\MedicineCatalogRepository;

class MedicineCatalogService
{
    public function __construct(
        protected MedicineCatalogRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
