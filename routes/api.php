<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::prefix('Ventas')->group(function () {
    Route::post('obtener_articulo', [ClientesController::class, 'obtenerInformacionArticulo']);
    Route::post('obtener_ventas', [ClientesController::class, 'obtenerVentas']);
    Route::post('crear_ventas', [ClientesController::class, 'saveVentas']);

});

Route::post('login', [AuthController::class, 'login']);

