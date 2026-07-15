<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post(
    '/onboarding',
    [UserController::class, 'onboarding']
);

Route::get(
    '/splash/{uuid}',
    [UserController::class, 'splash']
);

Route::get(
    '/profile/{uuid}',
    [UserController::class, 'profile']
);

Route::put(
    '/profile/{uuid}',
    [UserController::class,'updateProfile']
);