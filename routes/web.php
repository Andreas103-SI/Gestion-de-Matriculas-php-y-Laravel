
<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::resource('students', StudentController::class);
// Ruta GET para mostrar el formulario
Route::get('students/{student}/upload-certificate', [StudentController::class, 'showUploadCertificate'])->name('students.show-upload-certificate');
// Ruta POST para procesar la subida
Route::post('students/{student}/upload-certificate', [StudentController::class, 'uploadCertificate'])->name('students.upload-certificate');
// Ruta GET para descargar el certificado
Route::get('certificates/{certificate}/download', [StudentController::class, 'downloadCertificate'])->name('certificates.download');




Route::post('students/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');





Route::resource('courses', CourseController::class);

Route::resource('enrollments', EnrollmentController::class);
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
