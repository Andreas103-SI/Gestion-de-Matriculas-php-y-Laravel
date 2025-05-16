@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Estudiante</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
            @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Apellidos</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
            @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="dni_nie" class="form-label">DNI/NIE</label>
            <input type="text" name="dni_nie" id="dni_nie" class="form-control" value="{{ old('dni_nie', $student->dni_nie) }}" required>
            @error('dni_nie') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}" required>
            @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="disability" class="form-check-label">Discapacidad</label>
            <input type="checkbox" name="disability" id="disability" class="form-check-input" value="1" {{ old('disability', $student->disability) ? 'checked' : '' }}>
            @error('disability') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $student->address) }}</textarea>
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection