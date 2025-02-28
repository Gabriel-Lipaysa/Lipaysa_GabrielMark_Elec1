<?php

use App\Http\Controllers\MoneyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/money/{amount}', [MoneyController::class, 'calculate']);