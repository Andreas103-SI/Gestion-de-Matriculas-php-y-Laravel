@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Estudiantes</h1>
            <p class="text-muted">Administra los estudiantes registrados en el sistema</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-1"></i>Nuevo Estudiante
            </a>
            <a href="{{ route('students.trashed') }}" class="btn btn-outline-secondary">
                <i class="bi bi-trash me-1"></i>Eliminados
            </a>
            <a href="{{ route('students.xml') }}" class="btn btn-outline-primary">
                <i class="bi bi-download me-1"></i>XML
            </a>
        </div>
    </div>

    @include('partials.advanced-search-form')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 60px">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DNI/NIE</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Fecha Nac.</th>
                            <th scope="col" class="text-center">Discapacidad</th>
                            <th scope="col" class="text-center" style="width: 200px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td class="text-center">{{ $student->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary text-white me-2">
                                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $student->first_name }} {{ $student->last_name }}</div>
                                            <div class="small text-muted">{{ $student->address ?? 'Sin dirección' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $student->dni_nie }}</td>
                                <td>
                                    <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                        {{ $student->email }}
                                    </a>
                                </td>
                                <td>
                                    @if($student->phone)
                                        <a href="tel:{{ $student->phone }}" class="text-decoration-none">
                                            {{ $student->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $student->birth_date }}</td>
                                <td class="text-center">
                                    @if($student->disability)
                                        <span class="badge bg-info">Sí</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('students.show', $student) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('students.show-upload-certificate', $student) }}" 
                                           class="btn btn-sm btn-outline-success" 
                                           title="Subir certificado">
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este estudiante?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-people display-6 d-block mb-2"></i>
                                        No hay estudiantes registrados
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 0.875rem;
        }
        
        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }
        
        .btn-group .btn {
            padding: 0.25rem 0.5rem;
        }
        
        .table tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }
    </style>
@endsection
