<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ImageController;

Route::prefix('/centres')->group(function () {
    Route::get('/',                  [CentreController::class, 'index']);
    Route::get('/{centre}',          [CentreController::class, 'show']);
    Route::get('/{centre}/courses',  [CentreController::class, 'courses']);
    Route::get('/{centre}/teachers', [CentreController::class, 'teachers']);
    Route::get('/images',            [CentreController::class, 'images']);
    Route::post('/',                 [CentreController::class, 'store']);
    Route::delete('/{centre}',       [CentreController::class, 'destroy']);
});

Route::prefix('/courses')->group(function () {
    Route::get('/',                  [CourseController::class, 'index']);
    Route::get('/{course}',          [CourseController::class, 'show']);
    Route::get('/{course}/students', [CourseController::class, 'students']);
    Route::post('/',                 [CourseController::class, 'store']);
    Route::delete('/{course}',       [CourseController::class, 'destroy']);
});

Route::prefix('/students')->group(function () {
    Route::get('/',                   [StudentController::class, 'index']);
    Route::get('/{student}',          [StudentController::class, 'show']);
    Route::get('/{student}/courses',  [StudentController::class, 'courses']);
    Route::get('/{student}/teachers', [StudentController::class, 'teachers']);
    Route::post('/',                  [StudentController::class, 'store']);
    Route::delete('/{student}',       [StudentController::class, 'destroy']);
});

Route::prefix('/teachers')->group(function () {
    Route::get('/',                   [TeacherController::class, 'index']);
    Route::get('/{teacher}',          [TeacherController::class, 'show']);
    Route::get('/{teacher}/courses',  [TeacherController::class, 'courses']);
    Route::get('/{teacher}/students', [TeacherController::class, 'students']);
    Route::post('/',                  [TeacherController::class, 'store']);
    Route::delete('/{teacher}',       [TeacherController::class, 'destroy']);
});

Route::prefix('/images')->group(function () {
    Route::get('/',  [ImageController::class, 'index']);
    Route::post('/', [ImageController::class, 'store']);
});
