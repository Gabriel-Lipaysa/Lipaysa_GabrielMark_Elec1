<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;

// Public routes
Route::get('/', fn () => view('layouts.app'));
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin-only routes
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Teachers
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('create', [TeacherController::class, 'create'])->name('create');
        Route::post('insert', [TeacherController::class, 'insert'])->name('insert');
        Route::get('details/{id}', [TeacherController::class, 'show'])->name('details');
        Route::get('edit/{id}', [TeacherController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [TeacherController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [TeacherController::class, 'destroy'])->name('destroy');
    });

    // Students
    Route::prefix('students')->name('students.')->group(function () {
        //Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('create', [StudentController::class, 'create'])->name('create');
        Route::post('insert', [StudentController::class, 'insert'])->name('insert');
        Route::delete('delete/{id}', [StudentController::class, 'destroy'])->name('destroy');
    });

    // Courses
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CoursesController::class, 'index'])->name('index');
        Route::get('create', [CoursesController::class, 'create'])->name('create');
        Route::post('insert', [CoursesController::class, 'insert'])->name('insert');
        Route::get('details/{id}', [CoursesController::class, 'show'])->name('details');
        Route::get('edit/{id}', [CoursesController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CoursesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CoursesController::class, 'destroy'])->name('destroy');
    });

    // Enrollments
    Route::prefix('enrollments')->name('enrollments.')->group(function () {
        Route::get('/', [EnrollmentController::class, 'index'])->name('index');
        Route::get('create', [EnrollmentController::class, 'create'])->name('create');
        Route::post('insert', [EnrollmentController::class, 'insert'])->name('insert');
        Route::get('edit/{id}', [EnrollmentController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [EnrollmentController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [EnrollmentController::class, 'destroy'])->name('destroy');
    });
});

// Shared routes for teacher and admin
Route::middleware(['role:admin,teacher,student'])->group(function () {
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('details/{id}', [StudentController::class, 'show'])->name('details');
        Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [StudentController::class, 'update'])->name('update');
    });

    Route::prefix('students/{studentId}/grades')->name('students.grades.')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('index');
        Route::get('create', [GradeController::class, 'create'])->name('create');
        Route::post('store', [GradeController::class, 'store'])->name('store');
        Route::get('{gradeId}/edit', [GradeController::class, 'edit'])->name('edit');
        Route::put('{gradeId}', [GradeController::class, 'update'])->name('update');
    });
});

// Student-only routes
// Route::middleware(['role:student'])->group(function () {
//     Route::prefix('students')->name('students.')->group(function () {
//         Route::get('details/{id}', [StudentController::class, 'show'])->name('details');
//         Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit');
//         Route::post('update/{id}', [StudentController::class, 'update'])->name('update');
//     });

//     Route::get('students/{id}/grades', [GradeController::class, 'index'])->name('students.grades.index');
// });
