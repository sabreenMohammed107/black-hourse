<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('roles', 'App\Http\Controllers\RoleController');
Route::resource('users', 'App\Http\Controllers\UserController');
//company
Route::resource('company', 'App\Http\Controllers\CompanyController');
//branch
Route::resource('branch', 'App\Http\Controllers\BranchController');
//room
Route::resource('room', 'App\Http\Controllers\RoomController');
//round
Route::resource('round', 'App\Http\Controllers\RoundController');
//course
Route::resource('course', 'App\Http\Controllers\CourseController');
//trainer
Route::resource('trainer', 'App\Http\Controllers\TrainerController');
//student
Route::resource('student', 'App\Http\Controllers\StudentController');
//add-student-round
Route::post('add-student-round', 'App\Http\Controllers\StudentController@addStudent')->name('add-student-round');
//course-trainers
Route::resource('course-trainers', 'App\Http\Controllers\CourseTrainersController');
//course-rounds
Route::resource('course-rounds', 'App\Http\Controllers\CourseRoundsController');
//course-trianer-delete
Route::delete('course-trianer-delete\{id}', 'App\Http\Controllers\CourseTrainersController@delete')->name('course-trianer-delete');
//trainer-branch
Route::resource('trainer-branch', 'App\Http\Controllers\TrainerBranchController');
//deploma
Route::resource('deploma', 'App\Http\Controllers\DeplomaController');
//student
Route::resource('deploma-student', 'App\Http\Controllers\DeplomaStudentController');
//add-student-round
Route::post('add-student-deploma', 'App\Http\Controllers\DeplomaStudentController@addStudent')->name('add-student-deploma');
//course-deploma
Route::resource('course-deploma', 'App\Http\Controllers\CourseDeplomaController');
//start Round
Route::post('start-round', 'App\Http\Controllers\RoundController@startRound')->name('start-round');


