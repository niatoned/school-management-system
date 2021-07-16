<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentYearController;
use App\Http\Controllers\backend\setup\StudentGroupController;
use App\Http\Controllers\backend\setup\StudentShiftController;
use App\Http\Controllers\backend\setup\FeeCategoryController;
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\ExamTypeController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\setup\AssignSubjectController;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


//User management Routes
Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('user.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
    Route::get('/update/{id}', [UserController::class, 'UserDelete'])->name('user.delete');

});
//User profile and password
Route::prefix('profile')->group(function(){
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

});

//Setups Management
Route::prefix('setups')->group(function(){
    Route::get('/student/class/view', [StudentClassController::class, 'StudentView'])->name('student.class.view');
    Route::get('/student/class/add', [StudentClassController::class, 'StudentAdd'])->name('student.class.add');
    Route::post('/student/class/store', [StudentClassController::class, 'StudentStore'])->name('student.class.store');
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentDelete'])->name('student.class.delete');
    Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentEdit'])->name('student.class.edit');
    Route::post('/student/class/update/{id}', [StudentClassController::class, 'StudentUpdate'])->name('student.class.update');

    //Student year routes
    Route::get('/student/year/view', [StudentYearController::class, 'YearView'])->name('student.year.view');
    Route::get('/student/year/add', [StudentYearController::class, 'YearAdd'])->name('student.year.add');
    Route::post('/student/year/store', [StudentYearController::class, 'YearStore'])->name('student.year.store');
    Route::get('/student/year/edit/{id}', [StudentYearController::class, 'YearEdit'])->name('student.year.edit');
    Route::post('/student/year/update/{id}', [StudentYearController::class, 'YearUpdate'])->name('student.year.update');
    Route::get('/student/year/delete/{id}', [StudentYearController::class, 'YearDelete'])->name('student.year.delete');

     //Student group routes
    Route::get('/student/group/view', [StudentGroupController::class, 'GroupView'])->name('student.group.view');
    Route::get('/student/group/add', [StudentGroupController::class, 'GroupAdd'])->name('student.group.add');
    Route::post('/student/group/store', [StudentGroupController::class, 'GroupStore'])->name('student.group.store');
    Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'GroupEdit'])->name('student.group.edit');
    Route::post('/student/group/update/{id}', [StudentGroupController::class, 'GroupUpdate'])->name('student.group.update');
    Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'GroupDelete'])->name('student.group.delete');

    //Student shift routes
    Route::get('/student/shift/view', [StudentShiftController::class, 'ShiftView'])->name('student.shift.view');
    Route::get('/student/shift/add', [StudentShiftController::class, 'ShiftAdd'])->name('student.shift.add');
    Route::post('/student/shift/store', [StudentShiftController::class, 'ShiftStore'])->name('student.shift.store');
    Route::get('/student/shift/edit/{id}', [StudentShiftController::class, 'ShiftEdit'])->name('student.shift.edit');
    Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'ShiftUpdate'])->name('student.shift.update');
    Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'ShiftDelete'])->name('student.shift.delete');

     //Fee Category routes
    Route::get('/fee/category/view', [FeeCategoryController::class, 'FeeCatView'])->name('fee.category.view');
    Route::get('/fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');
    Route::post('/fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('fee.category.store');
    Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');
    Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'FeeCatUpdate'])->name('fee.category.update');
    Route::post('/fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCatDelete'])->name('fee.category.delete');

    //Fee amount routes
    Route::get('/fee/amount/view', [FeeAmountController::class, 'FeeAmountView'])->name('fee.amount.view');
    Route::get('/fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd'])->name('fee.amount.add');
    Route::post('/fee/amount/store', [FeeAmountController::class, 'FeeAmountStore'])->name('fee.amount.store');
    Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
    Route::post('/fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'FeeAmountUpdate'])->name('fee.amount.update');
    Route::get('/fee/amount/details/{id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

    //Exam type routes
    Route::get('/exam/type/view', [ExamTypeController::class, 'ExamTypeView'])->name('exam.type.view');
    Route::get('/exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
    Route::post('/exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('exam.type.store');
    Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
    Route::post('/exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('exam.type.update');
    Route::get('/exam/type/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');

    //School Subject routes
    Route::get('/school/subject/view', [SchoolSubjectController::class, 'SchoolSubjectView'])->name('school.subject.view');
    Route::get('/school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
    Route::post('/school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('school.subject.store');
    Route::get('/school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
    Route::post('/school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('school.subject.update');
    Route::get('/school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');

    //Assign Subject routes
    Route::get('/assign/subject/view', [AssignSubjectController::class, 'AssignSubjectView'])->name('assign.subject.view');
    Route::get('/assign/subject/add', [AssignSubjectController::class, 'AssignSubjectAdd'])->name('assign.subject.add');
    Route::post('/assign/subject/store', [AssignSubjectController::class, 'AssignSubjectStore'])->name('assign.subject.store');
    Route::get('/assign/subject/edit/{class_id}', [AssignSubjectController::class, 'AssignSubjectEdit'])->name('assign.subject.edit');
    Route::post('/assign/subject/update/{class_id}', [AssignSubjectController::class, 'AssignSubjectUpdate'])->name('assign.subject.update');
    Route::get('/assign/subject/details/{id}', [AssignSubjectController::class, 'AssignSubjectDetails'])->name('assign.subject.details');
    
});


