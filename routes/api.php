<?php

use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::prefix('Clientes')->group(function () {
    Route::post('StoreRegistro', [ClientesController::class, 'Registro']);
    Route::post('ObtenerClientes', [ClientesController::class, 'ObtenerClientes']);
    Route::post('ActualizarCliente', [ClientesController::class, 'ActualizaClientes']);
    Route::post('EliminarCliente', [ClientesController::class, 'DeleteClientes']);
    Route::get('/saludo', function () {
        return response()->json(['mensaje' => 'Hola desde la API']);
    });
});
