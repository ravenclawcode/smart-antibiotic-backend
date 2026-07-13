<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;

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
}
