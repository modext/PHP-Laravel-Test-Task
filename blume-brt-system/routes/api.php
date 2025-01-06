
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BrtController;


// Public routes for authentication
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::post('/reset-password', [NewPasswordController::class, 'store']);
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store']);
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/brts', [BrtController::class, 'store']); // Create a new BRT
    Route::get('/brts', [BrtController::class, 'index']); // Retrieve all BRTs for the user
    Route::get('/brts/{id}', [BrtController::class, 'show']); // Retrieve a specific BRT by ID
    Route::put('/brts/{id}', [BrtController::class, 'update']); // Update a specific BRT by ID
    Route::delete('/brts/{id}', [BrtController::class, 'destroy']); // Delete a specific BRT by ID
});
