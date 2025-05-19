@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Estudiante</h1>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.student-form', ['model' => $student, 'isEdit' => true])
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
