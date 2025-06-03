@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Matrículas</h1>
            <p class="text-muted">Administra las matrículas de estudiantes en cursos</p>
        </div>
        <div>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Nueva Matrícula
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width: 60px">#</th>
                            <th scope="col">Estudiante</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Fecha</th>
                            <th scope="col" class="text-center" style="width: 180px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrollments as $enrollment)
                            <tr>
                                <td class="text-center">{{ $enrollment->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary text-white me-2">
                                            {{ strtoupper(substr($enrollment->student->first_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">
                                                {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                                            </div>
                                            <div class="small text-muted">
                                                {{ $enrollment->student->dni_nie }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-book text-primary me-2"></i>
                                        <div>
                                            <div class="fw-medium">{{ $enrollment->course->name }}</div>
                                            <div class="small text-muted">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{ $enrollment->course->start_date }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($enrollment->enrollment_document)
                                        <a href="{{ asset('storage/' . $enrollment->enrollment_document) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           target="_blank"
                                           title="Ver documento">
                                            <i class="bi bi-file-earmark-text me-1"></i>
                                            Ver documento
                                        </a>
                                    @else
                                        <span class="text-muted">Sin documento</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check text-success me-2"></i>
                                        {{ $enrollment->enrollment_date }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('enrollments.show', $enrollment) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('enrollments.edit', $enrollment) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('enrollments.destroy', $enrollment) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta matrícula?');">
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
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-journal-text display-6 d-block mb-2"></i>
                                        No hay matrículas registradas
                                    </div>
                                    <a href="{{ route('enrollments.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-lg me-1"></i>Crear primera matrícula
                                    </a>
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