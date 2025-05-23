@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Matrículas</h1>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary mb-3">Crear Matrícula</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Documento</th>
                <th>Fecha de Matrícula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Recorre todos los registros de matrículas y muestra sus datos -->
            @forelse ($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->enrollment_document }}</td>
                    <td>{{ $enrollment->enrollment_date }}</td>
                    <td>
                        <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta matrícula?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay matrículas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection