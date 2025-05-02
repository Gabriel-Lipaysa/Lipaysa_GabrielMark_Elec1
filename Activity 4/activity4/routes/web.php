<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [PhotoController::class, 'create']);
Route::post('/upload-single', [PhotoController::class, 'storeSingle'])->name('single.image.upload');
Route::post('/upload-multiple', [PhotoController::class, 'storeMultiple'])->name('multiple.image.upload');
Route::delete('/photo/{photo}', [PhotoController::class, 'destroy'])->name('photo.destroy');
