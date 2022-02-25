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
//pay-student-round
Route::post('pay-student-round', 'App\Http\Controllers\RoundController@payStudentRound')->name('pay-student-round');

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
//fin-round-data
Route::get('fin-round-data\{id}', 'App\Http\Controllers\CurrentGroupsController@showFinData')->name('fin-round-data');

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
Route::get('dynamicCourse/fetch', 'App\Http\Controllers\InvoiceController@fetchCourse')->name('dynamicCourse.fetch');
//dynamicRound
Route::get('dynamicRound/fetch', 'App\Http\Controllers\InvoiceController@fetchRound')->name('dynamicRound.fetch');
//employee
Route::resource('employee', 'App\Http\Controllers\EmployeeController');

//payment
Route::resource('payment', 'App\Http\Controllers\PaymentController');
Route::get('paymentdynamicCourse/fetch', 'App\Http\Controllers\PaymentController@fetchCourse')->name('paymentdynamicCourse.fetch');
//dynamicRound
Route::get('paymentdynamicRound/fetch', 'App\Http\Controllers\PaymentController@fetchRound')->name('paymentdynamicRound.fetch');

//trainers-payment

Route::resource('trainers-payment', 'App\Http\Controllers\TrainerPaymentController');

Route::get('trainers-paymentdynamicCourse/fetch', 'App\Http\Controllers\TrainerPaymentController@fetchCourse')->name('trainers-paymentdynamicCourse.fetch');
//dynamicRound
Route::get('trainers-paymentdynamicRound/fetch', 'App\Http\Controllers\TrainerPaymentController@fetchRound')->name('trainers-paymentdynamicRound.fetch');
// employee-payment
Route::resource('employee-payment', 'App\Http\Controllers\EmployeePaymentController');

Route::get('employee-paymentdynamicSalary/fetch', 'App\Http\Controllers\EmployeePaymentController@fetchSalary')->name('employee-paymentdynamicSalary.fetch');
//dynamicRound
// Route::get('employee-paymentdynamicRound/fetch', 'App\Http\Controllers\EmployeePaymentController@fetchRound')->name('employee-paymentdynamicRound.fetch');

Route::resource('daily-schedule', 'App\Http\Controllers\DailyScheduleControler');

Route::get('branch-room/fetch', 'App\Http\Controllers\DailyScheduleControler@fetchRoom')->name('branch-room.fetch');

Route::resource('potential-clients', 'App\Http\Controllers\PotentialClientsController');
//change_funnel
Route::post('change_funnel', 'App\Http\Controllers\PotentialClientsController@funnel')->name('change_funnel');
Route::post('follow_save', 'App\Http\Controllers\PotentialClientsController@followSave')->name('follow_save');

Route::post('follow_update', 'App\Http\Controllers\PotentialClientsController@followUpdate')->name('follow_update');

//uninterested-clients
Route::resource('uninterested-clients', 'App\Http\Controllers\UninterestedClientsController');
Route::resource('certificates', 'App\Http\Controllers\CertificatesController');
//updatingCerificate
Route::post('updatingCerificate', 'App\Http\Controllers\CertificatesController@updatingCerificate')->name('updatingCerificate');


//waiting
Route::resource('waiting', 'App\Http\Controllers\WaitingController');
//saveStudent
Route::post('saveStudent', 'App\Http\Controllers\WaitingController@saveStudent')->name('saveStudent');



