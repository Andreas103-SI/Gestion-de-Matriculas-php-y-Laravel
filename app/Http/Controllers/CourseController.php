<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    // Muestra la lista de todos los cursos
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Muestra el formulario para crear un nuevo curso
    public function create()
    {
        return view('courses.create');
    }

    // Guarda un nuevo curso en la base de datos
    public function store(CourseRequest $request)
{
    Course::create($request->validated());

    return redirect()->route('courses.index')->with('success', 'Curso creado con éxito.');
}

    // Muestra los detalles de un curso específico
    public function show(Course $course)
{
    $course->load('enrollments');
    return view('courses.show', compact('course'));
}

    // Muestra el formulario para editar un curso existente
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Actualiza un curso existente en la base de datos
    public function update(CourseRequest $request, Course $course)
{
    $course->update($request->validated());

    return redirect()->route('courses.index')->with('success', 'Curso actualizado con éxito.');
}

    // Elimina un curso de la base de datos
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado con éxito.');
    }
}