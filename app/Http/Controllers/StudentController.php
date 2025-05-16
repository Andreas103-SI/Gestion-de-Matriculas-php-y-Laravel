<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Muestra la lista de todos los estudiantes
    public function index()
    {
        $students = Student::all();
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
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'required|date',
            'disability' => 'boolean',
            'address' => 'nullable|string|max:500',
        ]);

        Student::create($validated);

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
}


