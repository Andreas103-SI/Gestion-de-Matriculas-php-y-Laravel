<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;

class StudentCreated extends Mailable
{

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function build ()
    {
        return $this->view('emails.student-created')
            ->with('student', $this->student)
            ->subject('Confirmación de Registro de Estudiante');
    }

}
