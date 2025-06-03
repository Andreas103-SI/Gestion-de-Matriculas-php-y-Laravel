@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Gestión de Cursos</h1>
            <p class="text-muted">Administra los cursos disponibles en el sistema</p>
        </div>
        <div>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Nuevo Curso
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($courses as $course)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $course->name }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Inicio: {{ $course->start_date }}
                                </p>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-people me-1"></i>
                                {{ $course->capacity }} plazas
                            </span>
                        </div>
                        
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('courses.show', $course) }}" 
                               class="btn btn-sm btn-outline-primary flex-grow-1" 
                               title="Ver detalles">
                                <i class="bi bi-eye me-1"></i>Detalles
                            </a>
                            <a href="{{ route('courses.edit', $course) }}" 
                               class="btn btn-sm btn-outline-warning" 
                               title="Editar curso">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger" 
                                        title="Eliminar curso">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-book display-6 d-block mb-2"></i>
                            No hay cursos registrados
                        </div>
                        <a href="{{ route('courses.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-lg me-1"></i>Crear primer curso
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }
        
        .btn-group .btn {
            padding: 0.25rem 0.5rem;
        }
    </style>
@endsection