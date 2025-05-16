@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detalles del Curso</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $course->id }}</p>
            <p><strong>Nombre:</strong> {{ $course->name }}</p>
            <p><strong>Descripción:</strong> {{ $course->description ?? 'No especificada' }}</p>
            <p><strong>Fecha de Inicio:</strong> {{ $course->start_date }}</p>
            <p><strong>Fecha de Fin:</strong> {{ $course->end_date }}</p>
            <p><strong>Número de Estudiantes:</strong> {{ $course->students_count }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection