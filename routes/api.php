<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\UserController;

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');
Route::post('/auth/verify', [AuthController::class, 'verify']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/update/user', [UserController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/recent/{slug}', [BlogController::class, 'recent']);
Route::get('/blogs/{slug}', [BlogController::class, 'show']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/contacts', [ContactUsController::class, 'index']);
Route::get('/contact/{id}', [ContactUsController::class, 'show']);
Route::get('/contact/check-phone', [ContactUsController::class, 'checkPhone']);
Route::post('/contact', [ContactUsController::class, 'store']);
