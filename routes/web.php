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
Route::get('/room/1/full-calender', 'App\Http\Controllers\RoomController@fullCalender')->name('room/1/full-calender');

//round
Route::resource('round', 'App\Http\Controllers\RoundController');
//start Round
Route::post('start-round', 'App\Http\Controllers\RoundController@startRound')->name('start-round');

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

//current-groups

Route::resource('current-groups', 'App\Http\Controllers\CurrentGroupsController');
//accept-exeptions
Route::get('accept-exeptions', 'App\Http\Controllers\CurrentGroupsController@acceptExeptions')->name('accept-exeptions');
Route::post('exeption-accept\{id}', 'App\Http\Controllers\CurrentGroupsController@accept')->name('exeption-accept');
Route::post('exeption-reject\{id}', 'App\Http\Controllers\CurrentGroupsController@reject')->name('exeption-reject');
//fullowup

Route::resource('fullowup', 'App\Http\Controllers\FollowupController');
Route::resource('callcenter', 'App\Http\Controllers\CallCenterController');
//general-students

Route::resource('general-students', 'App\Http\Controllers\GeneralStudentsController');

//attendance

Route::resource('attendance', 'App\Http\Controllers\AttendanceController');
//Finance
//cashbox
Route::resource('cashbox', 'App\Http\Controllers\CashboxController');

//invoice
Route::resource('invoice', 'App\Http\Controllers\InvoiceController');
Route::get('dynamicBranch/fetch', 'App\Http\Controllers\InvoiceController@fetchBranch')->name('dynamicBranch.fetch');

