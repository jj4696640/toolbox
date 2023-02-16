<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    }
    );

    // Users Routes
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::put('/users/{id}', [UserController::class, 'changeStatus']);

    // Password Reset Routes
    Route::post('/password/email', [PasswordResetController::class, 'sendPasswordReset']);
    Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);

    // Logout Route
    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    });

    // Suspect Routes
    Route::get('/suspects', [SuspectController::class, 'index']);
    Route::get('/suspects/{id}', [SuspectController::class, 'show']);
    Route::post('/suspects', [SuspectController::class, 'store']);
    // Route::put('/suspects/{id}', [SuspectController::class, 'update']);
    // Route::delete('/suspects/{id}', [SuspectController::class, 'destroy']);
    
});

// Register Routes
Route::post('/users/register', [RegisterController::class, 'store']);

// Verify Routes
Route::get('/users/verify/{token}', [VerifyController::class, 'verify']);

// Login Route
Route::post("/users/login", [LoginController::class, 'login']);
