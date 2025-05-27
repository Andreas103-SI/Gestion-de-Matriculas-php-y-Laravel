<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\StudentLog;
use App\Enums\StudentAction;
use App\Traits\NormalizeName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentObserver
{
    use NormalizeName;

    public function saving(Student $student): void
    {
        $student->first_name = mb_strtolower(trim($student->first_name ?? ''));
        $student->last_name = mb_strtolower(trim($student->last_name ?? ''));
    }

    public function created(Student $student): void
    {
        $userId = Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => StudentAction::Created, // Usar el enum
        ]);

        Log::info("Estudiante creado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }

    public function updated(Student $student): void
    {
        $userId = Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => StudentAction::Updated, // Usar el enum
        ]);

        Log::info("Estudiante actualizado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }

    public function deleted(Student $student): void
    {
        $userId = Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => StudentAction::Deleted, // Usar el enum
        ]);

        Log::info("Estudiante eliminado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }

    public function restored(Student $student): void
    {
        $userId = Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => StudentAction::Restored, // Usar el enum
        ]);

        Log::info("Estudiante restaurado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }

    public function forceDeleted(Student $student): void
    {
        $userId = Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => StudentAction::ForceDeleted, // Usar el enum
        ]);
    }
}
