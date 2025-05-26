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

    use Queueable, SerializesModels;

    public $student;
    public $zipPath;

    public function __construct($student, $zipPath = null)
    {
        $this->student = $student;
        $this->zipPath = $zipPath;
    }

    public function build ()
    {
        $mail = $this->subject('Notificación de Inscripción')
                     ->view('emails.sendEmails');


        if ($this->zipPath !== null && file_exists($this->zipPath)) {
            $mail->attach($this->zipPath, [
                'as' => 'documentos_estudiante_' . $this->student->id . '.zip',
                'mime' => 'application/zip',
            ]);
        }

        return $mail;
    }

}
