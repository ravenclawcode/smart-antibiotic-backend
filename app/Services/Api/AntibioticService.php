<?php

namespace App\Services\Api;

use App\Repositories\Api\AntibioticRepository;

class AntibioticService
{
    public function __construct(
        protected AntibioticRepository $repository
    ) {}

    public function find(
        int $id
    )
    {
        return $this->repository->find(
            $id
        );
    }
}