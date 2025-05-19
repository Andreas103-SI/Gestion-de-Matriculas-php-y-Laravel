@extends('layouts.app')

@section('content')
    <h1 class ="mb-4">Editar Inscripción</h1>
    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partials.enrollment-form', ['model' => $enrollment, 'isEdit' => true])
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection