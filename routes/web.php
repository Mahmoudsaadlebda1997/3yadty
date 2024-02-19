<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SpecialtyController;
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

Route::get('/', function () {
    return view('welcome'); // Replace 'dashboard' with your actual dashboard view
});
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
        // Doctors
        Route::resource('doctors', DoctorController::class);
        // Users
        Route::resource('users', UserController::class);

        // Patients
        Route::resource('patients', PatientController::class);

        // Specialties
        Route::resource('specialties', SpecialtyController::class);

        // Appointments
        Route::resource('appointments', AppointmentController::class);
        // Sliders
        Route::resource('sliders', SliderController::class);

        Route::get('/dashboard', function () {
            return view('mainDashboard'); // Replace 'dashboard' with your actual dashboard view
        });
    });
});
