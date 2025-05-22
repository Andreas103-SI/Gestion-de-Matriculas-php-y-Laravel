@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Estudiante</h1>
    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('partials.student-form', ['isEdit' => false, 'model' => null])
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
