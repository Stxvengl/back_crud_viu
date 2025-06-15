<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/saludo', function () {
    return response()->json(['mensaje' => 'Hola desde la API']);
});

