@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Estudiantes Eliminados</h1>
    @include('partials.advanced-search-form', ['action' => route('students.trashed')])
    <div class="mb-3">
        <a href="{{ route('students.index') }}" class="btn btn-primary">Volver a Estudiantes</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI/NIE</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Discapacidad</th>
                <th>Dirección</th>
                <th>Eliminado en</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->dni_nie }}</td>
                    <td>{{ $student->email ?? 'Sin correo' }}</td>
                    <td>{{ $student->phone ?? 'Sin teléfono' }}</td>
                    <td>{{ $student->birth_date ? $student->birth_date->format('d/m/Y') : 'Sin fecha' }}</td>
                    <td>{{ $student->disability ? 'Sí' : 'No' }}</td>
                    <td>{{ $student->address ?? 'Sin dirección' }}</td>
                    <td>{{ $student->deleted_at ? $student->deleted_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                    <td>
                        <div>
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Editar</a>
                        </div>
                        <form action="{{ route('students.restore', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Restaurar estudiante?')">Restaurar</button>
                        </form>
                        <form action="{{ route('students.forceDelete', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar definitivamente?')">Eliminar Definitivamente</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No hay estudiantes eliminados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection