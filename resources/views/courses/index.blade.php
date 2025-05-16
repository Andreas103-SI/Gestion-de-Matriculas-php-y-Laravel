@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Cursos</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Crear Curso</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Capacidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Recorre todos los cursos y muestra sus datos -->
            <!-- Si no hay cursos, muestra un mensaje -->
            <!-- El formulario se envía mediante POST y se especifica el método DELETE -->
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->start_date }}</td>
                    <td>{{ $course->end_date }}</td>
                    <td>{{ $course->capacity }}</td>
                    <td>{{ number_format($course->price, 2) }} €</td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay cursos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection