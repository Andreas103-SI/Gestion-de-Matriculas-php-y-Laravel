<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileXmlController extends Controller
{
    public function create()
    {
        return view('xml.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|max:2048',
        ]);
        // Autenticación temporal para pruebas
        Auth::loginUsingId(3);

        $xmlFile = $request->file('xml_file');
        $xmlContent = $xmlFile->getContent();
        // Validar el contenido del XML
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            return redirect()->back()->with('error', 'Invalid XML file: ' . ($errors[0]->message ?? 'Unknown error'));
        }
        // Verificar que el XML tenga un nodo <students> o <DOCUMENT> con <students>
        $studentsNode = null;
        if ($xml->getName() === 'DOCUMENT' && isset($xml->students)) {
            $studentsNode = $xml->students;
        } elseif ($xml->getName() === 'students') {
            $studentsNode = $xml;
        } else {
            return redirect()->back()->with('error', 'XML must have a <students> node or a <DOCUMENT> root with <students> inside');
        }
        // Procesar los estudiantes
        $studentsCreated = 0;
        $studentsUpdated = 0;
        foreach ($studentsNode->student as $studentXml) {
            $dniNie = (string)$studentXml->dni_nie;
            $studentData = [
                'first_name' => (string)$studentXml->first_name,
                'last_name' => (string)$studentXml->last_name,
                'email' => (string)$studentXml->email,
                'dni_nie' => $dniNie,
                'phone' => (string)$studentXml->phone ?? null,
                'birth_date' => (string)$studentXml->birth_date,
                'disability' => filter_var((string)$studentXml->disability, FILTER_VALIDATE_BOOLEAN),
                'address' => (string)$studentXml->address ?? null,
            ];

            $student = Student::where('dni_nie', $dniNie)->first();
            if ($student) {
                // Actualizar estudiante existente
                $student->update($studentData);
                $studentsUpdated++;
            } else {
                // Crear nuevo estudiante
                Student::create($studentData);
                $studentsCreated++;
            }
        }
        // Mensaje de éxito
        $message = "Processed XML successfully.";
        if ($studentsCreated > 0 || $studentsUpdated > 0) {
            $message .= " Created $studentsCreated new students.";
            if ($studentsUpdated > 0) {
                $message .= " Updated $studentsUpdated existing students.";
            }
        }

        return redirect()->route('xml.upload')->with('success', $message);
    }
}
