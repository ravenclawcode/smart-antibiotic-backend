<?php

namespace App\Services\Api;

use App\Repositories\Api\PreferenceRepository;

class PreferenceService
{
    public function __construct(
        protected PreferenceRepository $repository
    ) {}

    public function show(
        int $userId
    ) {
        return $this->repository->show(
            $userId
        );
    }

    public function update(
        int $userId,
        array $data
    ) {
        return $this->repository->update(
            $userId,
            $data
        );
    }
}
