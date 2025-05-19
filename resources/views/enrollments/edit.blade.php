@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Matrícula</h1>
    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="student_id" class="form-label">Estudiante</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Selecciona un estudiante</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }} ({{ $student->dni_nie }})
                    </option>
                @endforeach
            </select>
            @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">Selecciona un curso</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="enrollment_date" class="form-label">Fecha de Matrícula</label>
            <input type="date" name="enrollment_date" id="enrollment_date" class="form-control" value="{{ old('enrollment_date', $enrollment->enrollment_date) }}" required>
            @error('enrollment_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection