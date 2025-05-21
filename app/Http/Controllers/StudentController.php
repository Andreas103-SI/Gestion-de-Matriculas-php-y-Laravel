<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Query\StudentSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentCreated;

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

        // Enviar correo de confirmación
        Mail::to($student->email)->send(new StudentCreated($student));

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

        return redirect()->route('students.index')->with('success', 'Estudiante actualizado con éxito.');
    }

    // Elimina un estudiante de la base de datos
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
        //dd($students); // Para verificar
        return view('students.trashed', compact('students'));
    }

    // Restaura un estudiante eliminado (soft delete)
    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.trashed')->with('success', 'Estudiante restaurado con éxito');
    }
    // Elimina un estudiante de forma permanente (hard delete)
    public function forceDelete($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->forceDelete();
        return redirect()->route('students.trashed')->with('success', 'Estudiante eliminado definitivamente');
    }
}


