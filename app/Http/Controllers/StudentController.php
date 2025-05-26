<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Query\StudentSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentCreated;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Nonstandard\Fields;

class StudentController extends Controller
{
    // Muestra la lista de todos los estudiantes
    public function index(Request $request)
    {
        $filter = $request->only(['first_name', 'last_name', 'email', 'dni_nie', 'disability']);
        $students = (new StudentSearch($filter))->search()->get();
        return view('students.index', compact('students'));
    }

    // Muestra el formulario para crear un nuevo estudiante
    public function create()
    {
        return view('students.create');
    }

    // Guarda un nuevo estudiante en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni_nie' => 'required|string|max:9|unique:students,dni_nie',
            'email' => 'nullable|email|max:255|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'required|date',
            'disability' => 'boolean',
            'address' => 'nullable|string|max:500',
        ]);

        $student = Student::create($validated);

        // Subir imagen solo si se proporciona un archivo
        if ($request->hasFile('document_image')) {
            $request->validate([
                'document_image' => 'image|mimes:jpeg,jpg,png|max:2048',
            ]);
            $file = $request->file('document_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('document_images', $fileName, 'public');
            $student->update(['document_image_path' => $filePath]);
        }

        // Enviar correo de confirmación solo si hay email
        if ($student->email) {
            try {
                Mail::to($student->email)->send(new StudentCreated($student));
            } catch (\Exception $e) {
                // No logueamos para mantener el controlador limpio, pero puedes usar dd si necesitas depurar
                // dd($e->getMessage());
            }
        }

        return redirect()->route('students.index')->with('success', 'Estudiante creado con éxito.');
    }

    // Muestra los detalles de un estudiante específico
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Muestra el formulario para editar un estudiante existente
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Actualiza un estudiante existente en la base de datos

    public function update(Request $request, Student $student)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dni_nie' => 'required|string|max:9|unique:students,dni_nie,' . $student->id,
                'email' => 'nullable|email|max:255|unique:students,email,' . $student->id,
                'phone' => 'nullable|string|max:20',
                'birth_date' => 'required|date',
                'disability' => 'boolean',
                'address' => 'nullable|string|max:500',
            ]);

            $student->update($validated);

            if ($request->hasFile('document_image')) {
                $request->validate([
                    'document_image' => 'image|mimes:jpeg,jpg,png|max:2048',
                ]);
                // Elimina la imagen anterior si existe
                if ($student->document_image_path) {
                    if (Storage::disk('public')->exists($student->document_image_path)) {
                        Storage::disk('public')->delete($student->document_image_path);
                    }
                }

                $namefile = time() . '_' . $request->file('document_image')->getClientOriginalName();
                $filePath = $request->file('document_image')->storeAs('document_images', $namefile, 'public');

                $student->update(['document_image_path' => $filePath]);
                // dd([
                //     'document_image_path' => $student->document_image_path,
                //     'asset_url' => asset('storage/' . $student->document_image_path),
                // ]); // Depuración
            }

            // Envía correo si hay email
            if ($student->email) {
                try {
                    Mail::to($student->email)->send(new StudentCreated($student));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }

            return redirect()->route('students.index')->with('success', 'Estudiante actualizado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el estudiante: ' . $e->getMessage());
        }
    }
    // Elimina un estudiante de la base de datos (soft delete)
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado con éxito.');
    }

    // Muestra la lista de estudiantes eliminados
    public function trashed(Request $request)
    {
        $filters = $request->only(['first_name', 'last_name', 'email', 'dni_nie', 'disability']);
        $students = (new StudentSearch($filters))->search()->onlyTrashed()->get();
        return view('students.trashed', compact('students'));
    }

    // Restaura un estudiante eliminado (soft delete)
    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();

        // Verificar si la imagen sigue existiendo; si no, resetear document_image_path
        if ($student->document_image_path && !Storage::disk('public')->exists($student->document_image_path)) {
            $student->update(['document_image_path' => null]);
        }

        return redirect()->route('students.trashed')->with('success', 'Estudiante restaurado con éxito.');
    }

    // Elimina un estudiante de forma permanente (hard delete)
    public function forceDelete(Student $student)
    {
        try {
            $student = Student::withTrashed()->findOrFail($student->id);
            $imagePath = $student->document_image_path;

            $student->forceDelete();

            // Eliminar la imagen asociada si existe
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                $deleted = Storage::disk('public')->delete($imagePath);
                if (!$deleted) {
                    // Usar dd para depurar si la imagen no se elimina
                    // dd("No se pudo eliminar la imagen: $imagePath");
                }
            }

            return redirect()->route('students.trashed')->with('success', 'Estudiante eliminado definitivamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar definitivamente: ' . $e->getMessage());
        }
    }

    // Muestra el formulario para subir un certificado
    public function showUploadCertificate($studentId)
    {
        $student = Student::findOrFail($studentId);
        return view('students.upload-certificate', compact('student'));
    }

    // Sube un certificado
    public function uploadCertificate(Request $request, $studentId)
    {
        $request->validate([
            'certificate' => 'required|file|mimes:pdf|max:2048', // Máximo 2MB
        ]);

        $student = Student::findOrFail($studentId);

        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('certificates', $fileName, 'public');

            Certificate::create([
                'student_id' => $student->id,
                'file_path' => $filePath,
                'file_name' => $fileName,
            ]);

            return redirect()->back()->with('success', 'Certificado subido con éxito.');
        }

        return redirect()->back()->with('error', 'No se pudo subir el certificado.');
    }

    // Descarga el certificado
    public function downloadCertificate($certificateId)
    {
        $certificate = Certificate::findOrFail($certificateId);

        if (Storage::disk('public')->exists($certificate->file_path)) {
            $absolutePath = Storage::disk('public')->path($certificate->file_path);
            return response()->download($absolutePath, $certificate->file_name);
        }

        return redirect()->back()->with('error', 'El certificado no se encuentra o no está disponible.');
    }

    // Genera un PDF del estudiante
    public function generatePdf($studentId)
    {
        $student = Student::findOrFail($studentId);
        $fields = [
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'dni_nie' => $student->dni_nie,
            'email' => $student->email,
            'phone' => $student->phone,
            'birth_date' => $student->birth_date,
            'disability' => $student->disability ? 'Sí' : 'No',
            'address' => $student->address,
        ];

        // Limpia los campos para evitar caracteres no válidos en el nombre del archivo
        $fields = array_map(function($value) {
            return preg_replace('/[^A-Za-z0-9_\-@.]/', '_', (string) $value);
        }, $fields);

        $filename = 'certificado_' . implode('_', $fields) . '.pdf';

        $pdf = Pdf::loadView('students.pdf', compact('fields'));

        // Guardar el PDF
        $path = Pdf::loadView('students.pdf', compact('fields'));

        // Guardar el PDF en storage/app/public/pdfs/
        $pdfPath = 'pdfs/' . $filename;
        Storage::disk('public')->put($pdfPath, $pdf->output());


        return response()->download(storage_path('app/public/' . $pdfPath));

    }

    // Genera un ZIP de certificados y de imagenes si las hay
    public function generateZip(Student $student)
    {
        $zip = new \ZipArchive();
        $tempZipPath = tempnam(sys_get_temp_dir(), 'student_zip_');
        $addCertificates = false;

        if ($zip->open($tempZipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {

            foreach ($student->certificates as $certificate) {
                $filePath = storage_path('app/public/' . $certificate->file_path);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, 'certificados/' . $certificate->file_name);
                    $addCertificates = true;
                }
            }

            if (!$addCertificates) {
                $fields = [
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'dni_nie' => $student->dni_nie,
                    'email' => $student->email,
                    'phone' => $student->phone,
                    'birth_date' => $student->birth_date,
                    'disability' => $student->disability ? 'Sí' : 'No',
                    'address' => $student->address,
                ];

                $pdf = Pdf::loadView('students.pdf', compact('fields'));
                $pdfContent = $pdf->output();
                $pdfTempPath = tempnam(sys_get_temp_dir(), 'student_pdf_');
                file_put_contents($pdfTempPath, $pdfContent);
                $zip->addFile($pdfTempPath, 'certificados/certificado_estudiante_' . $student->id . '.pdf');
                $addCertificates = true;
            }

            if ($student->document_image_path && Storage::disk('public')->exists($student->document_image_path)) {
                $imagePath = storage_path('app/public/' . $student->document_image_path);
                $zip->addFile($imagePath, 'imagenes/' . basename($imagePath));
            }

            $zip->close();

            if (!$addCertificates) {
                return response()->json(['error' => 'No se encontraron archivos para incluir en el ZIP.'], 500);
            }

            return response()->download($tempZipPath, 'documentos_estudiante_' . $student->id . '.zip')->deleteFileAfterSend(true);
        }

        return response()->json(['error' => 'No se pudo crear el archivo ZIP.'], 500);
    }

}
