<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AtvController;
use App\Http\Controllers\Api\AtvImageController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Password reset routes
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

// ATV routes (public read access)
Route::get('/atvs', [AtvController::class, 'index']);
Route::get('/atvs/{atv}', [AtvController::class, 'show']);
Route::get('/atvs/{atv}/images', [AtvController::class, 'images']);
Route::get('/atvs/{atv}/gallery', [AtvController::class, 'gallery']);
Route::get('/atvs/{atv}/primary-image', [AtvController::class, 'primaryImage']);

// Public brand routes
Route::get('/brands', [AtvController::class, 'brands']);

// Blog routes (public read access)
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);

// Contact routes (public)
Route::post('/contact', [ContactController::class, 'store']);

// ATV Images routes (public read access)
Route::get('/atvs/{atv_id}/images', [AtvImageController::class, 'index']);
Route::get('/atvs/{atv_id}/images/{id}', [AtvImageController::class, 'show']);

// Location routes (public read access)
Route::get('/locations', [LocationController::class, 'index']);
Route::get('/locations/{location}', [LocationController::class, 'show']);
Route::get('/locations/georgian/cities', [LocationController::class, 'georgianCities']);
Route::get('/locations/countries', [LocationController::class, 'countries']);
Route::get('/locations/search', [LocationController::class, 'search']);
Route::get('/locations/popular', [LocationController::class, 'popular']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Authentication routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Password change route
    Route::post('/change-password', [PasswordResetController::class, 'changePassword']);
    
    // ATV management routes (authenticated)
    Route::post('/atvs', [AtvController::class, 'store']);
    Route::put('/atvs/{atv}', [AtvController::class, 'update']);
    Route::delete('/atvs/{atv}', [AtvController::class, 'destroy']);
    
    // Blog management routes (authenticated)
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
    
    // ATV Images management routes (authenticated)
    Route::post('/atvs/{atv_id}/images', [AtvImageController::class, 'store']);
    Route::put('/atvs/{atv_id}/images/{id}', [AtvImageController::class, 'update']);
    Route::delete('/atvs/{atv_id}/images/{id}', [AtvImageController::class, 'destroy']);
    Route::post('/atvs/{atv_id}/images/{id}/set-primary', [AtvImageController::class, 'setPrimary']);
    
    // Location management routes (authenticated)
    Route::post('/locations', [LocationController::class, 'store']);
    Route::put('/locations/{location}', [LocationController::class, 'update']);
    Route::delete('/locations/{location}', [LocationController::class, 'destroy']);
});

// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is running',
        'timestamp' => now(),
    ]);
});
