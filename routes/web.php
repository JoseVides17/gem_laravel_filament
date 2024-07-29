<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/empleados/{id}', [\App\Http\Controllers\EmpleadoController::class, 'show'])->name('empleados.show');


Route::get('/empleados/{empleado}/detalles', [\App\Http\Controllers\EmpleadoController::class, 'show'])->name('empleados.detalles');
