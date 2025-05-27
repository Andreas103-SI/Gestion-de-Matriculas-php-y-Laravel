<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\StudentLog;
use App\Traits\NormalizeName;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
        $userId = Auth::id() ?? 1; // Usa ID 1 como fallback si no hay usuario autenticado (por ejemplo, en pruebas)

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => 'created',
        ]);

        Log::info("Estudiante creado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }


    public function updated(Student $student): void
    {
        $userId = Auth::id() ?? 1; // Usa ID 1 como fallback si no hay usuario autenticado (por ejemplo, en pruebas)

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => 'updated',
        ]);

        Log::info("Estudiante actualizado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        $userId = Auth::id() ?? 1; // Usa ID 1 como fallback si no hay usuario autenticado (por ejemplo, en pruebas)

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => 'deleted',
        ]);

        Log::info("Estudiante eliminado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
    }


    public function restored(Student $student): void
    {
        $userId = Auth::id() ?? 1; // Usa ID 1 como fallback si no hay usuario autenticado (por ejemplo, en pruebas)

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => 'restored',
        ]);

        Log::info("Estudiante restaurado con nombre: {$student->first_name} {$student->last_name} por usuario ID: {$userId}");
        $userId = $userId ?? 1; // Usa ID 1 como fallback si no hay usuario autenticado (por ejemplo, en pruebas)
    }


    public function forceDeleted(Student $student): void
    {
        $userId =Auth::id() ?? 1;

        StudentLog::create([
            'user_id' => $userId,
            'student_id' => $student->id,
            'action' => 'force_deleted',
        ]);
    }
}
