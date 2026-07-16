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
}
