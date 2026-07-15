<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\Admin\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find(
        User $user
    ) {
        return $this->repository->find(
            $user
        );
    }

    // public function onboarding(
    //     array $data
    // ) {
    //     return $this->repository
    //         ->onboarding($data);
    // }

    // public function findByUuid(
    //     string $uuid
    // ) {
    //     return $this->repository
    //         ->findByUuid($uuid);
    // }

    // public function getProfile(
    //     string $uuid
    // ) {
    //     return $this->repository
    //         ->getProfile($uuid);
    // }

    // public function updateProfile(
    //     string $uuid,
    //     array $data
    // ) {
    //     return $this->repository
    //         ->updateProfile(
    //             $uuid,
    //             $data
    //         );
    // }
}
