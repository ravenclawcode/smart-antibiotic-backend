<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MedicineCatalogController;
use App\Http\Controllers\Api\AntibioticCategoryController;
use App\Http\Controllers\Api\AntibioticController;

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
    [UserController::class, 'updateProfile']
);

Route::get(
    '/medicine-catalog',
    [MedicineCatalogController::class, 'index']
);

Route::get(
    '/categories',
    [AntibioticCategoryController::class, 'index']
);

Route::get(
    '/categories/{category}/antibiotics',
    [AntibioticCategoryController::class, 'antibiotics']
);

Route::get(
    '/antibiotics/{id}',
    [AntibioticController::class, 'show']
);
