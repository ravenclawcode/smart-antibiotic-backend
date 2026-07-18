<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MedicineCatalogController;
use App\Http\Controllers\Api\AntibioticCategoryController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PreferenceController;
use App\Http\Controllers\Api\MedicineHistoryController;

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

Route::prefix('preferences')->group(function () {

    Route::get('{uuid}', [
        PreferenceController::class,
        'show'
    ]);

    Route::put('{uuid}', [
        PreferenceController::class,
        'update'
    ]);
});

Route::get(
    '/medicine-catalogs',
    [MedicineCatalogController::class, 'index']
);

Route::get('/categories', [
    AntibioticCategoryController::class,
    'index'
]);

Route::get('/categories/{category}/antibiotics', [
    AntibioticCategoryController::class,
    'antibiotics'
]);

Route::get('/categories/{category}/antibiotics/{antibiotic}', [
    AntibioticCategoryController::class,
    'show'
]);

Route::prefix('medicines')->group(function () {
    Route::get('/', [MedicineController::class, 'index']);
    Route::post('/', [MedicineController::class, 'store']);
    Route::get('/{medicine}', [MedicineController::class, 'show']);
    Route::put('/{medicine}', [MedicineController::class, 'update']);
    Route::delete('/{medicine}', [MedicineController::class, 'destroy']);
});

Route::prefix('medicine-histories')->group(function () {
    Route::post('/taken', [MedicineHistoryController::class, 'taken']);
    Route::post('/skipped', [MedicineHistoryController::class, 'skipped']);
    Route::post('/reschedule', [MedicineHistoryController::class, 'reschedule']);
    Route::post('/missed', [MedicineHistoryController::class, 'missed']);
});