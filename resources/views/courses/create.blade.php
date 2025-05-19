@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Curso</h1>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @include('partials.course-form', ['isEdit' => false])
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection