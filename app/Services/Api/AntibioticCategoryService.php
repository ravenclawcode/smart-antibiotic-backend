<?php

namespace App\Services\Api;

use App\Repositories\Api\AntibioticCategoryRepository;

class AntibioticCategoryService
{
    public function __construct(
        protected AntibioticCategoryRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function antibiotics(
        int $categoryId
    ) {
        return $this->repository->antibiotics(
            $categoryId
        );
    }
}
