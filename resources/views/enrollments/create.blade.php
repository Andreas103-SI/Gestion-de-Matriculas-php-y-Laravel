@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Inscripción</h1>
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        @include('partials.enrollment-form', ['isEdit' => false])
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection