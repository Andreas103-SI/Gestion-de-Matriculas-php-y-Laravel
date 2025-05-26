<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwoFactorController;
use App\Http\Middleware\TwoFactorMiddleware;


/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard (autenticado)
|--------------------------------------------------------------------------
*/
Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'twofactor'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'twofactor'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil de usuario
    |--------------------------------------------------------------------------
    */
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Estudiantes
    |--------------------------------------------------------------------------
    */
    Route::resource('students', StudentController::class);

    Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
    Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::post('students/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');

    // PDF y ZIP
    Route::get('students/{student}/pdf', [StudentController::class, 'generatePdf'])->name('students.pdf');
    Route::get('students/{student}/preview-pdf', [StudentController::class, 'previewPdf'])->name('students.preview-pdf');
    Route::get('students/{student}/generate-zip', [StudentController::class, 'generateZip'])->name('students.generate-zip');

    // Certificados
    Route::get('students/{student}/upload-certificate', [StudentController::class, 'showUploadCertificate'])->name('students.show-upload-certificate');
    Route::post('students/{student}/upload-certificate', [StudentController::class, 'uploadCertificate'])->name('students.upload-certificate');
    Route::get('certificates/{certificate}/download', [StudentController::class, 'downloadCertificate'])->name('certificates.download');

    /*
    |--------------------------------------------------------------------------
    | Cursos y Matrículas
    |--------------------------------------------------------------------------
    */
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
});

require __DIR__.'/auth.php';
