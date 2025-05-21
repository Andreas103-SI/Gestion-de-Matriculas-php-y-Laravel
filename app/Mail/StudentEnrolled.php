<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use App\Models\Course;

class StudentEnrolled extends Mailable
{
    public $student;
    public $course;

    public function __construct(Student $student, Course $course)
    {
        $this->student = $student;
        $this->course = $course;
    }

    public function build()
    {
        return $this->view('emails.student-enrolled')
            ->with([
                'student' => $this->student,
                'course' => $this->course,
            ])
            ->subject('Confirmación de Inscripción en Curso');
    }
}