<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('roles', App\Http\Controllers\API\RoleAPIController::class);

Route::resource('training', App\Http\Controllers\API\TrainingAPIController::class);

Route::resource('training.chapter', App\Http\Controllers\API\TrainingChapterAPIController::class);

Route::resource('users', App\Http\Controllers\API\UserAPIController::class);


Route::resource('course_categories', App\Http\Controllers\API\CourseCategoryAPIController::class);

Route::resource('courses', App\Http\Controllers\API\CourseAPIController::class);

Route::resource('exams', App\Http\Controllers\API\ExamAPIController::class);

Route::resource('questions', App\Http\Controllers\API\QuestionAPIController::class);

Route::resource('question_options', App\Http\Controllers\API\QuestionOptionAPIController::class);

Route::resource('course_chapters', App\Http\Controllers\API\CourseChapterAPIController::class);