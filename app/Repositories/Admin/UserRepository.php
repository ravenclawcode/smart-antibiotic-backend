<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
