<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/course-admin')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class,'login'])->name('login.send');

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/',function (){
            return view('courses');
        })->name('courses');
        Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    });


});

