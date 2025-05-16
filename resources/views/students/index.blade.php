@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Estudiantes</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Crear Estudiante</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI/NIE</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Discapacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
            <!-- Recorre todos los estudiantes y muestra sus datos -->
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->dni_nie }}</td>
                    <td>{{ $student->phone ?? 'N/A' }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->disability ? 'Sí' : 'No' }}</td>
                    <td>
                        <!-- Botón para ver detalles del estudiante -->
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">Ver</a>
                        <!-- Botón para editar estudiante -->
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Editar</a>
                        <!-- El formulario se envía mediante POST y se especifica el método DELETE -->
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay estudiantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection