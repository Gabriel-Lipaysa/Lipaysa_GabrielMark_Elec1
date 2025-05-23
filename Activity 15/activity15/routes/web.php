<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CatController;

Route::get('/cats', [CatController::class, 'showCats'])->name('cats');

Route::get('/weather/{city1?}/{city2?}/{city3?}', [WeatherController::class, 'getWeather']);

Route::get('/', function () {
    return view('welcome');
});
