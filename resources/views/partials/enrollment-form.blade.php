
@php
    // Parámetros por defecto
    $model = $model ?? null; // Objeto del modelo (ej. $enrollment)
    $isEdit = $isEdit ?? false; // true para edit, false para create
    $students = $students ?? []; // Lista de estudiantes para el select
    $courses = $courses ?? []; // Lista de cursos para el select
@endphp

<div class="mb-3">
    <label for="student_id" class="form-label">Estudiante</label>
    <select name="student_id" id="student_id" class="form-control" required>
        <option value="">Seleccione un estudiante</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}"
                {{ old('student_id', $isEdit ? $model->student_id : '') == $student->id ? 'selected' : '' }}>
                {{ $student->first_name }} {{ $student->last_name }} ({{ $student->dni_nie }})
            </option>
        @endforeach
    </select>
    @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="course_id" class="form-label">Curso</label>
    <select name="course_id" id="course_id" class="form-control" required>
        <option value="">Seleccione un curso</option>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}"
                {{ old('course_id', $isEdit ? $model->course_id : '') == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
            </option>
        @endforeach
    </select>
    @error('course_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="enrollment_date" class="form-label">Fecha de Matrícula</label>
    <input type="datetime-local" name="enrollment_date" id="enrollment_date" class="form-control"
           value="{{ old('enrollment_date', $isEdit && $model->enrollment_date ? $model->enrollment_date->format('Y-m-d\TH:i') : '') }}" required>
    @error('enrollment_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>