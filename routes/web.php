<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [
    HomeController::class, 'index'
])->name('home');

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::resource('courseCategories', App\Http\Controllers\CourseCategoryController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('training', App\Http\Controllers\TrainingController::class);
Route::resource('training.chapter', App\Http\Controllers\TrainingChapterController::class);
Route::post('training/{training}/take', [App\Http\Controllers\TrainingController::class, 'take']);

Route::resource('courses', App\Http\Controllers\CourseController::class);
Route::resource('courses.chapter', App\Http\Controllers\CourseChapterController::class);
Route::post('course/{course}/take', [App\Http\Controllers\CourseController::class, 'take']);

Route::resource('exams', App\Http\Controllers\ExamController::class);
Route::post('exams/{exam}/take', [App\Http\Controllers\ExamController::class, 'take']);
Route::post('exams/{exam}/submit', [App\Http\Controllers\ExamController::class, 'submit']);
Route::resource('exams.questions', App\Http\Controllers\QuestionController::class);
Route::resource('exams.questions.options', App\Http\Controllers\QuestionOptionController::class);
Route::patch('exams/{exam}/questions/{question}/options/{option}/set-correct', [App\Http\Controllers\QuestionOptionController::class, 'setCorrect']);
