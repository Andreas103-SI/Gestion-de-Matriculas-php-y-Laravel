<?php

namespace App\Observers;

use App\Models\Student;
use App\Traits\NormalizeName;
use Illuminate\Support\Facades\Log;


class StudentObserver
{

    use NormalizeName;

    public function saving(Student $student): void
    {
        $student->first_name = mb_strtolower(trim($student->first_name ?? ''));
        $student->last_name = mb_strtolower(trim($student->last_name ?? ''));
    }


    public function updated(Student $student): void
    {
       //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
