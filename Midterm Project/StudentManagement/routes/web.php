<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Students Routes
Route::get('/students',[StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students/insert', [StudentController::class, 'insert'])->name('students.insert');
Route::get('/students/details/{id}', [StudentController::class, 'show'])->name('students.details');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::post('/courses/insert', [CoursesController::class, 'insert'])->name('courses.insert');
Route::get('/courses/details/{id}', [CoursesController::class, 'show'])->name('courses.details');
Route::get('/courses/edit/{id}', [CoursesController::class, 'edit'])->name('courses.edit');
Route::post('/courses/update/{id}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('/courses/delete/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');


Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('/enrollments/insert', [EnrollmentController::class, 'insert'])->name('enrollments.insert');
Route::get('/enrollments/edit/{id}', [EnrollmentController::class, 'edit'])->name('enrollments.edit');
Route::post('/enrollments/update/{id}', [EnrollmentController::class, 'update'])->name('enrollments.update');
Route::delete('/enrollments/delete/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

Route::get('/students/{id}/grades', [GradeController::class, 'index'])->name('students.grades.index');
Route::post('/students/{id}/grades/update', [GradeController::class, 'update'])->name('students.grades.update');


Route::prefix('students/{studentId}/grades')->name('students.grades.')->group(function () {
    Route::get('index', [GradeController::class, 'index'])->name('index');
    Route::get('create', [GradeController::class, 'create'])->name('create');
    Route::post('store', [GradeController::class, 'store'])->name('store');
    Route::get('{gradeId}/edit', [GradeController::class, 'edit'])->name('edit');
    Route::put('{gradeId}', [GradeController::class, 'update'])->name('update');
});

