<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\StudentCreated;
use App\Models\Enrollment;
use Carbon\Carbon;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;

class SendNotifications extends Command
{
    // Nombre y firma del comando
    protected $signature = 'notifications:send';
    // Descripción del comando
    protected $description = 'Enviar email a los estudiantes';

    public function handle()
    {
        // Obtener la fecha de ayer en formato de cadena
        $yesterday = Carbon::yesterday()->toDateString();

        // Obtener las inscripciones donde la fecha de inscripción sea ayer
        $enrollments = Enrollment::whereDate('enrollment_date', $yesterday)->get();

        // Si no se encontraron inscripciones de ayer, se muestra una advertencia
        if ($enrollments->isEmpty()) {
            $this->warn('No se encontraron estudiantes inscritos ayer.');
            return;
        }

        // Enviar correo a cada estudiante inscrito ayer
        foreach ($enrollments as $enrollment) {
            $student = $enrollment->student;
            // Generar el ZIP con los documentos del estudiante
            $zipFilePath = $this->generateZipForStudent($student);

            // Enviar correo adjuntando el ZIP
            Mail::to('test@example.com')->send(new StudentCreated($student, $zipFilePath));

            // Eliminar el ZIP temporal si existe
            if ($zipFilePath && file_exists($zipFilePath)) {
                unlink($zipFilePath);
            }
        }

        // Informar que los correos fueron enviados correctamente
        $this->info('Notificaciones por correo enviadas exitosamente a todos los estudiantes inscritos ayer.');
    }

    private function generateZipForStudent($student)
    {
        $zip = new ZipArchive();
        $tempZipPath = tempnam(sys_get_temp_dir(), 'student_zip_');
        $addCertificates = false;

        if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

            // Agregar certificados PDF asociados
            foreach ($student->certificates as $certificate) {
                $filePath = storage_path('app/public/' . $certificate->file_path);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, 'certificados/' . $certificate->file_name);
                    $addCertificates = true;
                }
            }

            // Si no hay certificados, generar un PDF con la información del estudiante
            if (!$addCertificates) {
                $fields = [
                    'first_name' => $student->first_name,
                    'last_name'  => $student->last_name,
                    'dni_nie'    => $student->dni_nie,
                    'email'      => $student->email,
                    'phone'      => $student->phone,
                    'birth_date' => $student->birth_date,
                    'disability' => $student->disability ? 'Sí' : 'No',
                    'address'    => $student->address,
                ];

                $pdf = Pdf::loadView('students.pdf', compact('fields'));
                $pdfContent = $pdf->output();
                $pdfTempPath = tempnam(sys_get_temp_dir(), 'student_pdf_');
                file_put_contents($pdfTempPath, $pdfContent);
                $zip->addFile($pdfTempPath, 'certificados/certificado_estudiante_' . $student->id . '.pdf');
                $addCertificates = true;
            }

            // Agregar la imagen del documento del estudiante (si existe)
            if ($student->document_image_path && Storage::disk('public')->exists($student->document_image_path)) {
                $imagePath = storage_path('app/public/' . $student->document_image_path);
                $zip->addFile($imagePath, 'imagenes/' . basename($imagePath));
            }

            $zip->close();

            // Verificar que se agregó al menos un archivo
            if (!$addCertificates) {
                return null;
            }

            return $tempZipPath;
        }

        return null;
    }
}

