<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MedicineCatalogController;
use App\Http\Controllers\Api\AntibioticCategoryController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PreferenceController;
use App\Http\Controllers\Api\MedicineHistoryController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\ChatbotController;

// Onboarding
Route::post(
    '/onboarding',
    [UserController::class, 'onboarding']
);

// Cek apakah UUID sudah terdaftar
Route::get(
    '/splash/{uuid}',
    [UserController::class, 'splash']
);

// Katalog obat
Route::get(
    '/medicine-catalogs',
    [MedicineCatalogController::class, 'index']
);

// Kategori antibiotik
Route::prefix('categories')->group(function () {

    Route::get(
        '/',
        [AntibioticCategoryController::class, 'index']
    );

    Route::get(
        '/search',
        [AntibioticCategoryController::class, 'search']
    );

    Route::get(
        '/{category}/antibiotics',
        [AntibioticCategoryController::class, 'antibiotics']
    );

    Route::get(
        '/{category}/antibiotics/{antibiotic}',
        [AntibioticCategoryController::class, 'show']
    );
});

// Kuis
Route::prefix('quizzes')->group(function () {

    Route::get(
        '/',
        [QuizController::class, 'index']
    );
    Route::get(
        '/{quiz}',
        [QuizController::class, 'show']
    );
});

Route::middleware('resolve.user')->group(function () {

    // Home
    Route::get('/home', [
        HomeController::class,
        'index'
    ]);

    // Profile
    Route::prefix('profile')->group(function () {

        Route::get(
            '/',
            [UserController::class, 'profile']
        );
        Route::put(
            '/',
            [UserController::class, 'updateProfile']
        );
    });

    // Preferences
    Route::prefix('preferences')->group(function () {

        Route::get(
            '/',
            [PreferenceController::class, 'show']
        );
        Route::put(
            '/',
            [PreferenceController::class, 'update']
        );
    });

    Route::prefix('medicines')->group(function () {

        Route::get(
            '/',
            [MedicineController::class, 'index']
        );
        Route::post(
            '/',
            [MedicineController::class, 'store']
        );
        Route::get(
            '/{medicine}',
            [MedicineController::class, 'show']
        );
        Route::put(
            '/{medicine}',
            [MedicineController::class, 'update']
        );
        Route::delete(
            '/{medicine}',
            [MedicineController::class, 'destroy']
        );
        Route::delete(
            '/{medicine}/permanent',
            [MedicineController::class, 'destroyPermanent']
        );
        Route::put(
            '/{medicine}/dose',
            [MedicineController::class, 'updateDose']
        );
        Route::delete(
            '/{medicine}/single-dose',
            [MedicineController::class, 'destroySingleDose']
        );
    });

    // Medicines
    Route::prefix('medicine-histories')->group(function () {

        Route::get(
            '/',
            [MedicineHistoryController::class, 'index']
        );
        Route::get(
            '/filter-medicines',
            [MedicineHistoryController::class, 'filterMedicines']
        );
        Route::get(
            '/export-pdf',
            [MedicineHistoryController::class, 'exportPdf']
        );
        Route::post(
            '/taken',
            [MedicineHistoryController::class, 'taken']
        );
        Route::post(
            '/skipped',
            [MedicineHistoryController::class, 'skipped']
        );
        Route::post(
            '/reschedule',
            [MedicineHistoryController::class, 'reschedule']
        );
        Route::post(
            '/missed',
            [MedicineHistoryController::class, 'missed']
        );
        Route::post(
            '/cancel',
            [MedicineHistoryController::class, 'cancel']
        );
    });

    // Quiz Result
    Route::post(
        '/quizzes/{quiz}/submit',
        [QuizController::class, 'submit']
    );

    // Feedback
    Route::prefix('feedbacks')->group(function () {

        Route::get(
            '/',
            [FeedbackController::class, 'index']
        );
        Route::post(
            '/',
            [FeedbackController::class, 'store']
        );
        Route::delete(
            '/{feedback}',
            [FeedbackController::class, 'destroy']
        );
    });

    //Chatbot
    Route::prefix('chatbot')->group(function () {

        Route::get(
            '/session',
            [ChatbotController::class, 'session']
        );
        Route::post(
            '/send',
            [ChatbotController::class, 'send']
        );
        Route::delete(
            '/session',
            [ChatbotController::class, 'destroy']
        );
    });
});
