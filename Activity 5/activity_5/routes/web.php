<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationsController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/{operand1}/{num1}/{num2}/{operand2}/{num3}/{num4}', [OperationsController::class,'fetch']);