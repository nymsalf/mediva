<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientMedicalRecordController;
use App\Http\Controllers\PatientPrescriptionController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorMedicalRecordController;
use App\Http\Controllers\DoctorMedicalRecordIndexController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\DoctorPatientDetailController;
use App\Http\Controllers\DoctorPrescriptionController;

// Publik
Route::get('/', fn () => view('dashboard'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Pasien
Route::middleware(['auth', 'role:patient'])->prefix('patient')->group(function () {
    Route::get('/', [PatientController::class, 'dashboard']);
    Route::get('/appointments', [PatientAppointmentController::class, 'index']);
    Route::get('/appointments/create', [PatientAppointmentController::class, 'create']);
    Route::post('/appointments', [PatientAppointmentController::class, 'store']);
    Route::get('/medical-records', [PatientMedicalRecordController::class, 'index']);
    Route::get('/prescriptions', [PatientPrescriptionController::class, 'index']);
});

// Dokter
Route::middleware(['auth', 'role:doctor'])
    ->prefix('doctor')
    ->group(function () {

        Route::get('/', [DoctorController::class, 'dashboard']);

        Route::get('/appointments', [DoctorAppointmentController::class, 'index']);

        Route::patch(
            '/appointment/{id}/status',
            [DoctorAppointmentController::class, 'updateStatus']
        );

        Route::get('/appointment/{id}', [DoctorController::class, 'appointment']);

        Route::get(
            '/appointment/{id}/medical-record/create',
            [DoctorMedicalRecordController::class, 'create']
        );

        Route::post(
            '/appointment/{id}/medical-record',
            [DoctorMedicalRecordController::class, 'store']
        );

        Route::get(
            '/appointment/{id}/prescription/create',
            [DoctorPrescriptionController::class, 'create']
        );

        // Route::post(
        //     '/appointment/{id}/prescription',
        //     [DoctorPrescriptionController::class, 'store']
        // );

        Route::get('/patients', [DoctorPatientController::class, 'index']);

        Route::get('/patient/{id}', [DoctorPatientDetailController::class, 'show']);

        Route::get(
            '/medical-records',
            [DoctorMedicalRecordIndexController::class, 'index']
        );
    });