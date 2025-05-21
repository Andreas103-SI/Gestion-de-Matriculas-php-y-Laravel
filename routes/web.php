
<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;


Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
Route::post('students/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');
Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');


Route::get('/', function () {
    return view('welcome');
});