<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\EnrollmentRequest;
use ZipArchive;


class EnrollmentController extends Controller
{
    // Muestra la lista de todas las matrículas con sus estudiantes y cursos relacionados
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    // Muestra el formulario para crear una nueva matrícula
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }

    // Guarda una nueva matrícula en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
        ]);

        $validated['enrollment_document'] = \Illuminate\Support\Str::uuid();

        $enrollment = Enrollment::create($validated);

        // Obtener estudiante y curso
        $student = Student::findOrFail($validated['student_id']);
        $course = Course::findOrFail($validated['course_id']);

        // Depurar para verificar datos
        Log::info('Enviando correo a: ' . $student->email);
        Log::info('Curso: ' . $course->name);

        // Enviar correo de confirmación
        if ($student->email) {
            Mail::to($student->email)->send(new \App\Mail\StudentEnrolled($student, $course));
        } else {
            Log::warning('El estudiante no tiene correo electrónico: ' . $student->id);
        }

        return redirect()->route('enrollments.index')->with('success', 'Matrícula creada con éxito.');
    }
    // Muestra los detalles de una matrícula específica
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'course']);
        return view('enrollments.show', compact('enrollment'));
    }

    // Muestra el formulario para editar una matrícula existente
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    // Actualiza una matrícula existente en la base de datos
    public function update(EnrollmentRequest $request, \App\Models\Enrollment $enrollment)
{
    $enrollment->update($request->validated());
    return redirect()->route('enrollments.index')->with('success', 'Matrícula actualizada con éxito.');
}

    // Elimina una matrícula de la base de datos
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Matrícula eliminada con éxito.');
    }
}
