<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TemplateController;
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
    return view('template.index'); // Replace 'dashboard' with your actual dashboard view
});
// Public routes for template
Route::get('/template/login', [TemplateController::class, 'showLoginForm'])->name('loginTemplate');

// Public routes for template
Route::get('/template/register', [TemplateController::class, 'showRegisterForm'])->name('registerTemplate');
// Public routes for template
Route::post('/template/register', [TemplateController::class, 'store'])->name('storePatient');
// Public routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// Authenticated routes
Route::middleware('web')->group(function () {

    // Login Template routes
    Route::post('/template/login', [TemplateController::class, 'login']);

    // Logout Template route
    Route::get('/logoutTemplate', [TemplateController::class, 'logout'])->name('logoutTemplate');


    // Main Page Template routes
    Route::get('/', [TemplateController::class, 'mainPage']);

    // Login routes
    Route::post('/login', [UserController::class, 'login']);

    // Logout route
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Dashboard route (protected by auth middleware)
    Route::middleware(['auth'])->group(function () {
        // appointment for Patient route
        Route::get('/template/appointment', [TemplateController::class, 'myAppointments'])->name('myAppointment');
        // appointment for Patient route
        Route::post('/template/appointment/store', [TemplateController::class, 'storeAppointment'])->name('storeAppointment');
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

        Route::get('myAppointments', [AppointmentController::class, 'myAppointments'])->name('myAppointments');
        // Sliders
        Route::resource('sliders', SliderController::class);

        Route::get('/dashboard', function () {
            return view('mainDashboard'); // Replace 'dashboard' with your actual dashboard view
        });
    });
});
