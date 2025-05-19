@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Curso</h1>
    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $course->name) }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $course->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d\TH:i') : '') }}" required>
            @error('start_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Fecha de Fin</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $course->end_date ? $course->end_date->format('Y-m-d\TH:i') : '') }}" required>
            @error('end_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacidad</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $course->capacity) }}" required>
            @error('capacity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Ubicación</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $course->location) }}">
            @error('location') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $course->price) }}" step="0.01" required>
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection