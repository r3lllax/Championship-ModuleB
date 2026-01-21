<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CoursesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/course-admin')->group(function () {
    Route::get('/login', [AuthController::class,'index'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.send');

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/',[CoursesController::class,'index'])->name('courses');

        Route::get('/courses/create',[CoursesController::class,'create'])->name('courses.create');
        Route::post('/courses/create',[CoursesController::class,'store'])->name('courses.send');

        Route::get('/courses/{course}/edit',[CoursesController::class,'show'])->name('courses.edit');
        Route::post('/courses/{course}/edit',[CoursesController::class,'edit'])->name('courses.sendEdit');

        Route::get('/courses/{course}/delete',[CoursesController::class,'delete'])->name('courses.delete');
        Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    });


});

