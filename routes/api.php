<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\RecordController;
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
        Route::get('/{course}',[CourseController::class,'show']);
        Route::post('/{course}/buy',[CourseController::class,'store']);
    });
    Route::prefix('/orders')->group(function () {
        Route::get('/',[RecordController::class,'index']);
    });
});
