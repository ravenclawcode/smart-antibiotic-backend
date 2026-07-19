<?php

namespace App\Repositories\Admin;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::with(
            'preference'
        )
            ->oldest()
            ->paginate(10);
    }

    public function find(
        User $user
    ) {
        return $user->load(
            'preference'
        );
    }
}
