<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('app', function () {
        return Inertia::render('loggedApp');
    })->name('app');

    Route::post('word', [WordController::class, 'store'])
        ->name('word.add');

    Route::get('words', [WordController::class, 'index'])
        ->name('word.index');

    Route::post('/exercise/generate', [ExerciseController::class, 'generate'])
        ->name('exercise.generate');

    Route::post('/exercise', [ExerciseController::class, 'store'])
        ->name('exercise.store');

    Route::get('/my-exercises', [ExerciseController::class, 'index'])
        ->name('my-exercises.index');
});
/*
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('throttle:6,1');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
*/

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
