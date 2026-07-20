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

Route::post('/onboarding', [UserController::class, 'onboarding']);

Route::get('/splash/{uuid}', [UserController::class, 'splash']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/medicine-catalogs', [MedicineCatalogController::class, 'index']);

Route::prefix('profile')->group(function () {
    Route::get('/{uuid}', [UserController::class, 'profile']);
    Route::put('/{uuid}', [UserController::class, 'updateProfile']);
});

Route::prefix('preferences')->group(function () {
    Route::get('{uuid}', [PreferenceController::class, 'show']);
    Route::put('{uuid}', [PreferenceController::class, 'update']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [AntibioticCategoryController::class, 'index']);
    Route::get('/{category}/antibiotics', [AntibioticCategoryController::class, 'antibiotics']);
    Route::get('/{category}/antibiotics/{antibiotic}', [AntibioticCategoryController::class, 'show']);
});

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

Route::prefix('medicine-histories')->group(function () {
    Route::get('/', [MedicineHistoryController::class, 'index']);
    Route::get('/filter-medicines', [MedicineHistoryController::class, 'filterMedicines']);
    Route::get('/export-pdf', [MedicineHistoryController::class, 'exportPdf']);
});

Route::prefix('quizzes')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::get('/{quiz}', [QuizController::class, 'show']);
    Route::post('/{quiz}/submit', [QuizController::class, 'submit']);
});

Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbackController::class, 'index']);
    Route::post('/', [FeedbackController::class, 'store']);
    Route::delete('/{feedback}', [FeedbackController::class, 'destroy']);
});

Route::prefix('chatbot')->group(function () {
    Route::get('/session', [ChatbotController::class, 'session']);
    Route::post('/send', [ChatbotController::class, 'send']);
    Route::delete('/session', [ChatbotController::class, 'destroy']);
});
