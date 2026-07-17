<?php

namespace App\Services\Api;

use App\Repositories\Api\PreferenceRepository;

class PreferenceService
{
    public function __construct(
        protected PreferenceRepository $repository
    ) {}

    public function show(
        string $uuid
    ) {
        return $this->repository->show(
            $uuid
        );
    }

    public function update(
        string $uuid,
        array $data
    ) {
        return $this->repository->update(
            $uuid,
            $data
        );
    }
}
