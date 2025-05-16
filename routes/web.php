
<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class);

Route::get('/', function () {
    return view('welcome');
});