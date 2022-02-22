<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\test;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentviewController;
use App\Http\Controllers\AdviserviewController;
use App\Http\Controllers\SignatoryviewController;
use App\Http\Controllers\PrerequisiteController;
use App\Http\Controllers\UsersImportController;


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
Route::get('/test',[test::class,'get']);
// Route::get('/test', function () {
//     return view('test');
// });

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [LoginController::class, 'stafflogin'])->name('login');

Route::group(['middleware'=>'auth'],function(){
    // ADMIN------------------------------------------------------------------------------
            Route::group(['middleware'=>'rank:admin'],function(){
                
                Route::resource('schoolyear',SchoolyearController::class);
                Route::get('/SYlist',[SchoolyearController::class,'get'])->name('schoolyear.getschoolyear');
                Route::get('/update/{id}',[SchoolyearController::class,'update'])->name('schoolyear.update');
                Route::get('/delete/{id}',[SchoolyearController::class,'destroy'])->name('schoolyear.delete');

                Route::resource('adviser',AdviserController::class);
                Route::get('/adviserlist',[AdviserController::class,'getadviser'])->name('adviser.getadviser');
                Route::get('/adviser/update/{id}',[AdviserController::class,'update'])->name('adviser.update');
                Route::get('/adviser/delete/{id}',[AdviserController::class,'destroy'])->name('adviser.delete');

                Route::resource('signatory',SignatoryController::class);
                Route::get('/signatorylist',[SignatoryController::class,'getsignatory'])->name('signatory.getsignatory');
                Route::get('/signatory/update/{id}',[SignatoryController::class,'update'])->name('signatory.update');
                Route::get('/signatory/delete/{id}',[SignatoryController::class,'destroy'])->name('signatory.delete');

                Route::resource('classroom',ClassroomController::class);
                Route::get('/classroomlist',[ClassroomController::class,'getclassroom'])->name('classroom.getclassroom');
                Route::get('/getadviser',[ClassroomController::class,'adviser'])->name('classroom.adviser');

                Route::resource('clearance',ClearanceController::class);
                Route::get('/getclearannce',[ClearanceController::class,'getclearance'])->name('clearance.getclearance');
                Route::get('/assignatories',[ClearanceController::class,'assignatory'])->name('clearance.assignatories');
                Route::get('/clearance/update/{id}',[ClearanceController::class,'update'])->name('clearance.update');
                Route::get('/deletes/{id}',[ClearanceController::class,'destroy'])->name('clearance.delete');
                Route::get('/destroyassig/{id}',[ClearanceController::class,'destroyassignatory'])->name('clearance.destroyassig');

                Route::resource('student',StudentController::class);
                Route::get('/studentlist',[StudentController::class,'getstudent'])->name('student.getstudent');
                Route::get('/studentclassroom',[StudentController::class,'classroom'])->name('student.studentclassroom');
                Route::get('/student/update/{id}',[StudentController::class,'update'])->name('student.update');
                Route::get('/student/delete/{id}',[StudentController::class,'destroy'])->name('student.delete');

                Route::resource('prereq',PrerequisiteController::class);

                Route::get('impo', [UsersImportController::class, 'show']);
                Route::post('file-import', [UsersImportController::class, 'fileImport'])->name('file-import');
                Route::get('file-export', [UsersImportController::class, 'fileExport'])->name('file-export');
            });
    
    // STAFF------------------------------------------------------------------------------
            Route::group(['middleware'=>'rank:staff'],function(){
                Route::group(['middleware'=>'role:signatory'],function(){
                    Route::resource('signatoryview',SignatoryviewController::class);
                    Route::get('/signatoryview/clearances/view',[SignatoryviewController::class, 'getclearance'])->name('signatoryview.clearances');
                    Route::get('/signatoryview/update/status',[SignatoryviewController::class, 'select'])->name('select');
                });
                Route::group(['middleware'=>'role:adviser'],function(){
                    Route::resource('adviserview',AdviserviewController::class);
                });    
            });

        // STUDENT------------------------------------------------------------------------------
            Route::group(['middleware'=>'rank:student'],function(){
                Route::get('getmyclearance', [StudentviewController::class, 'getclearance'])->name('getmyclearance');
                Route::get('requirement', [StudentviewController::class, 'requirements'])->name('requirement');
            });  
            
    });

    Route::get('logout', function () {
        Auth::logout();
        session()->invalidate();
        return redirect('/');
    })->name('logout');

