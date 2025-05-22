@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Estudiantes Eliminados</h2>
                    </div>
                    <div class="card-body">
                        @include('partials.advanced-search-form', ['action' => route('students.trashed')])

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('students.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left me-2"></i>Volver a Estudiantes
                            </a>
                        </div>

                        @if ($students->isEmpty())
                            <div class="alert alert-info">
                                No hay estudiantes eliminados.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
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
                                        @foreach ($students as $student)
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
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('students.restore', $student) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('¿Restaurar estudiante?')">
                                                                <i class="bi bi-arrow-counterclockwise me-2"></i>Restaurar
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('students.forceDelete', $student) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar definitivamente?')">
                                                                <i class="bi bi-trash me-2"></i>Eliminar Definitivamente
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
