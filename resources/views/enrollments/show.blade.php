@extends('layouts.app')

@seccion('content')
    <h1 class="mb-4">Detalles de la Matriculación</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $enrollment-id}}</p>
            <P><strong>Estuadiante: </strong> {{ $enrollement->student ->firts_name}}
            <p><strong>Curso:</strong> {{ $enrollement-> course}}</p>
            <P><strong>Fecha de Matriculación:</strong> {{ $enrrollement-> enrollment_date}}</p>
            <P><strong>Estado:</strong> {{ $enrollement-> startus}}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route ('enrollments.edit', $enrollment) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route ('enrollments.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection

