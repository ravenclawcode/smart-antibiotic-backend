<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function index()
    {
        $users = $this->service->getAll();

        return view(
            'admin.users.index',
            compact(
                'users'
            )
        );
    }

    public function show(
        User $user
    ) {
        $user = $this->service->find(
            $user
        );

        return view(
            'admin.users.show',
            compact(
                'user'
            )
        );
    }
}
