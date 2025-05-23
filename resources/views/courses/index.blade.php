@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Cursos</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Crear Curso</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->start_date }}</td>
                    <td>{{ $course->capacity }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection