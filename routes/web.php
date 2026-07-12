<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\MedicineCatalogController;
use App\Http\Controllers\Admin\AntibioticController;
use App\Http\Controllers\Admin\AntibioticCategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {

    Route::controller(AdminAuthController::class)->group(function () {

        Route::get('/login', 'showLogin')
            ->name('login');

        Route::post('/login', 'login')
            ->name('login.process');
    });
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'dashboard.index')
            ->name('dashboard');

        Route::resource(
            'medicine-catalog',
            MedicineCatalogController::class
        );
        Route::resource('antibiotics', AntibioticController::class);
        Route::resource(
            'categories',
            AntibioticCategoryController::class
        );
    });
