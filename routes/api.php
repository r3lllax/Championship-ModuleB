<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth',[AuthController::class,'login']);
Route::post('/registr',[AuthController::class,'registration']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::prefix('/courses')->group(function () {
        Route::get('',[CourseController::class,'index']);
    });
});
