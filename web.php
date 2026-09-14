<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ConsultationController;

/*
|--------------------------------------------------------------------------
| Landing (pública)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |----------------------------------------------------------------
    | Dashboard
    |----------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    /*
    |----------------------------------------------------------------
    | Pacientes
    |----------------------------------------------------------------
    */
    Route::resource('pacientes', PatientController::class);

    // Evaluaciones (anidadas a paciente)
    Route::prefix('pacientes/{paciente}/evaluaciones')
        ->name('evaluaciones.')
        ->group(function () {
            Route::get('/create', [EvaluationController::class, 'create'])->name('create');
            Route::post('/', [EvaluationController::class, 'store'])->name('store');
        });

    /*
    |----------------------------------------------------------------
    | Citas
    |----------------------------------------------------------------
    */
    Route::resource('citas', AppointmentController::class);

    Route::patch('/citas/{cita}/cancelar', [AppointmentController::class, 'cancel'])
        ->name('citas.cancel');

    /*
    |----------------------------------------------------------------
    | Consultas
    |----------------------------------------------------------------
    */
    Route::resource('consultas', ConsultationController::class);

    /*
    |----------------------------------------------------------------
    | Pagos
    |----------------------------------------------------------------
    */
    Route::resource('pagos', PaymentController::class);

    /*
    |----------------------------------------------------------------
    | Progreso
    |----------------------------------------------------------------
    */
    Route::prefix('progreso')
        ->name('progreso.')
        ->group(function () {
            Route::get('/', [ProgressController::class, 'index'])->name('index');
            Route::get('/{paciente}', [ProgressController::class, 'show'])->name('show');
        });

    /*
    |----------------------------------------------------------------
    | Perfil
    |----------------------------------------------------------------
    */
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });
});

require __DIR__.'/auth.php';
