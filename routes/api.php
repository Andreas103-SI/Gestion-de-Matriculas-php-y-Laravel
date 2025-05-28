<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentLogController;

Route::get('student-logs', [StudentLogController::class, 'index']);
