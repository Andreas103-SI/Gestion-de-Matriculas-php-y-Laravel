@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Estudiantes</h1>
    @include('partials.advanced-search-form')
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Crear Estudiante</a>
    <a href="{{ route('students.trashed') }}" class="btn btn-info">Ver Eliminados</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI/NIE</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Fecha de Nacimiento</th>
                <th>Discapacidad</th>
                <th>Dirección</th>
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
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone ?? 'N/A' }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->disability ? 'Sí' : 'No' }}</td>
                    <td>{{ $student->address ?? 'N/A' }}</td>

                    <td>
                        <div class="btn-group" role="group">
                            <!-- Botón para ver detalles del estudiante -->
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">Ver</a>
                            <!-- Botón para editar estudiante -->
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Editar</a>
                            <!-- Botón para subir certificado -->
                            <a href="{{ route('students.show-upload-certificate', $student) }}" class="btn btn-sm btn-primary">Subir Certificado</a>
                            <!-- Botón para descargar certificados -->
                            @foreach ($student->certificates as $certificate)
                                <a href="{{ route('certificates.download', $certificate->id) }}" class="btn btn-sm btn-success mt-1">
                                    <i class="bi bi-download me-2"></i>Descargar Certificado
                                </a>
                            @endforeach

                            <!-- El formulario se envía mediante POST y se especifica el método DELETE -->
                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay estudiantes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
