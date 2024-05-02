<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/fail',[App\Http\Controllers\HomeController::class,'unthenticathed'])->name('fail');

Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [App\Http\Controllers\Api\UserController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Api\UserController::class,'logout']);
    Route::get('/dashboard', [App\Http\Controllers\Api\DashboardController::class,'index']);

    Route::group(['prefix' => 'student'] , function () {
        Route::get('/lista',[App\Http\Controllers\Api\StudentController::class,'index']);
        Route::post('/register',[App\Http\Controllers\Api\StudentController::class,'register']);
        Route::get('/{id}',[App\Http\Controllers\Api\StudentController::class,'find']);
        Route::post('/update/{id}',[App\Http\Controllers\Api\StudentController::class,'updated']);
        Route::delete('/{id}',[App\Http\Controllers\Api\StudentController::class,'delete']);
    });

    Route::group(['prefix' => 'course'] , function () {
        Route::get('/lista',[App\Http\Controllers\Api\CourseController::class,'index']);
        Route::post('/register',[App\Http\Controllers\Api\CourseController::class,'register']);
        Route::get('/{id}',[App\Http\Controllers\Api\CourseController::class,'find']);
        Route::post('/update/{id}',[App\Http\Controllers\Api\CourseController::class,'updated']);
        Route::delete('/{id}',[App\Http\Controllers\Api\CourseController::class,'delete']);
    });
});
