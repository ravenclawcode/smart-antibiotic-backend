<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::with(
            'preference'
        )
            ->latest()
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
