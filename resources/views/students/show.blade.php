@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detalles del Estudiante</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $student->id }}</p>
            <p><strong>Nombre:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
            <p><strong>DNI/NIE:</strong> {{ $student->dni_nie }}</p>
            <p><strong>Teléfono:</strong> {{ $student->phone ?? 'No especificado' }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $student->birth_date }}</p>
            <p><strong>Discapacidad:</strong> {{ $student->disability ? 'Sí' : 'No' }}</p>
            <p><strong>Dirección:</strong> {{ $student->address ?? 'No especificada' }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection