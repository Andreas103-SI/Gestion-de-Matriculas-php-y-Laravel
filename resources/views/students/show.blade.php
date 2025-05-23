@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Detalles del Estudiante</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <strong>Nombre:</strong> {{ $student->first_name }}
                        </div>
                        <div class="mb-3">
                            <strong>Apellidos:</strong> {{ $student->last_name }}
                        </div>
                        <div class="mb-3">
                            <strong>DNI/NIE:</strong> {{ $student->dni_nie }}
                        </div>
                        <div class="mb-3">
                            <strong>Correo Electrónico:</strong> {{ $student->email ?? 'No proporcionado' }}
                        </div>
                        <div class="mb-3">
                            <strong>Teléfono:</strong> {{ $student->phone ?? 'No proporcionado' }}
                        </div>
                        <div class="mb-3">
                            <strong>Fecha de Nacimiento:</strong> {{ $student->birth_date }}
                        </div>
                        <div class="mb-3">
                            <strong>Discapacidad:</strong> {{ $student->disability ? 'Sí' : 'No' }}
                        </div>
                        <div class="mb-3">
                            <strong>Dirección:</strong> {{ $student->address ?? 'No proporcionada' }}
                        </div>
                        <div class="mb-3">
                            <strong>Imagen del Documento:</strong>
                            @if ($student->document_image_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $student->document_image_path) }}" alt="Imagen del Documento" style="max-width: 150px; height: auto;" class="img-thumbnail">
                                </div>
                            @else
                                <p>No hay imagen disponible.</p>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Editar
                            </a>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Volver
                            </a>
                            <a href="{{ route('students.pdf', $student) }}" class="btn btn-success" target="_blank">
                                <i class="bi bi-file-earmark-pdf me-2"></i>Descargar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
