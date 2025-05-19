<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

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
            // 'enrollment_document' ya no se valida porque se genera automáticamente
            'enrollment_date' => 'required|date',
        ]);

        // Generar UUID automáticamente
        $validated['enrollment_document'] = \Illuminate\Support\Str::uuid();

        Enrollment::create($validated);

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
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_document' => 'required|string|max:255',
            'enrollment_date' => 'required|date',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')->with('success', 'Matrícula actualizada con éxito.');
    }

    // Elimina una matrícula de la base de datos
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Matrícula eliminada con éxito.');
    }
}