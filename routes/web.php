<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\LandingController;


Route::get('/', [LandingController::class, 'index'])
    ->name('landing');
    
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::resource('pagos', PaymentController::class);
Route::resource('consultas', ConsultationController::class);
Route::get('/progreso',[ProgressController::class, 'index'])->name('progreso.index');
Route::get(
    '/progreso',
    [ProgressController::class, 'index']
)->name('progreso.index');


Route::get(
    '/progreso/{paciente}',
    [ProgressController::class, 'show']
)->name('progreso.show');

Route::middleware('auth')->group(function () {

    Route::get('/pacientes/{paciente}/evaluaciones/create', [EvaluationController::class, 'create'])
    ->name('evaluaciones.create');

    Route::post('/pacientes/{paciente}/evaluaciones', [EvaluationController::class, 'store'])
    ->name('evaluaciones.store');    

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::resource('pacientes', PatientController::class);

    Route::resource('citas', AppointmentController::class);

    Route::patch('/citas/{cita}/cancelar',
    [AppointmentController::class, 'cancel'])->name('citas.cancel');

});

require __DIR__.'/auth.php';