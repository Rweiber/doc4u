<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\SearchController;

// Rota para a página inicial
Route::get('/', [SearchController::class, 'index']);

// Rotas para consultas
Route::get('/consulta/create', [ConsultaController::class, 'create']);
Route::get('/consultas', [ConsultaController::class, 'index']);
Route::post('/consultas', [ConsultaController::class, 'store']);

// Rotas para especialidades
Route::get('/especialidades', [EspecialidadeController::class, 'index']);

// Rotas para pacientes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas do PacienteController
    Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create'); 
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store'); 
});

