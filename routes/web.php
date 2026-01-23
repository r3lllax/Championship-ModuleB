<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/course-admin')->group(function () {
    Route::get('/login', [AuthController::class,'index'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.send');

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/courses',[CourseController::class,'index'])->name('courses');

        Route::get('/students',[StudentController::class,'index'])->name('students.index');

        Route::get('/courses/create',[CourseController::class,'create'])->name('courses.create');
        Route::post('/courses/create',[CourseController::class,'store'])->name('courses.send');

        Route::get('/courses/{course}/lessons',[CourseController::class,'lessons'])->name('courses.lessons');

        Route::get('/courses/{course}/lessons/create',[LessonController::class,'create'])->name('lessons.create');
        Route::post('/courses/{course}/lessons/create',[LessonController::class,'store'])->name('lessons.store');

        Route::get('/lessons/{lesson}/edit',[LessonController::class,'edit'])->name('lessons.edit');
        Route::post('/lessons/{lesson}/edit',[LessonController::class,'storeEdit'])->name('lessons.storeEdit');
        Route::get('/lessons/{lesson}/delete',[LessonController::class,'delete'])->name('lessons.delete');


        Route::get('/courses/{course}/edit',[CourseController::class,'show'])->name('courses.edit');
        Route::post('/courses/{course}/edit',[CourseController::class,'edit'])->name('courses.sendEdit');

        Route::get('/courses/{course}/students/{student}/certificate',[StudentController::class,'certificate'])->name('students.certificate');

        Route::get('/courses/{course}/delete',[CourseController::class,'delete'])->name('courses.delete');
        Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    });


});

