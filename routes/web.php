<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// Authenticated routes
Route::middleware('web')->group(function () {
    // Login routes
    Route::post('/login', [UserController::class, 'login']);

    // Logout route
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Dashboard route (protected by auth middleware)
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard'); // Replace 'dashboard' with your actual dashboard view
        });
    });
});
