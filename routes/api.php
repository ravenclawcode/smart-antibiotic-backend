<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post(
    '/onboarding',
    [UserController::class, 'onboarding']
);

Route::middleware('resolve.user')
    ->group(function () {

        Route::get(
            '/profile',
            [UserController::class, 'profile']
        );

        Route::put(
            '/profile',
            [UserController::class, 'update']
        );
    });
