@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Curso</h1>
    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.course-form', ['model' => $course, 'isEdit' => true])
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection