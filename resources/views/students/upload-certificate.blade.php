@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Subir Certificado para {{ $student->first_name }} {{ $student->last_name }}</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('students.upload-certificate', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="certificate" class="form-label">
                                    <i class="bi bi-file-earmark-pdf-fill me-2"></i>Certificado (PDF, máximo 2MB)
                                </label>
                                <input type="file" name="certificate" id="certificate" class="form-control" accept=".pdf" required>
                                @error('certificate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload me-2"></i>Subir Certificado
                                </button>
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Volver
                                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
