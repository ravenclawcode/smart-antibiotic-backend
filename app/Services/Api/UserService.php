<?php

namespace App\Services\Api;

use App\Models\User;
use App\Repositories\Api\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    public function onboarding(
        array $data
    ) {
        return $this->repository
            ->onboarding($data);
    }

    public function existsByUuid(
        string $uuid
    ): bool {
        return $this->repository
            ->existsByUuid(
                $uuid
            );
    }

    public function getProfile(
        string $uuid
    ) {
        return $this->repository
            ->getProfile($uuid);
    }

    public function updateProfile(
        User $user,
        array $data
    ) {
        return $this->repository->updateProfile(
            $user,
            $data
        );
    }
}
