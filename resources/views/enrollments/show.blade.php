
@section('content')
    <h1 class="mb-4">Detalles de la Matrícula</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $enrollment->id }}</p>
            <p><strong>Estudiante:</strong> {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }} ({{ $enrollment->student->dni_nie }})</p>
            <p><strong>Curso:</strong> {{ $enrollment->course->name }}</p>
            <p><strong>Documento:</strong> {{ $enrollment->enrollment_document }}</p>
            <p><strong>Fecha de Matrícula:</strong> {{ $enrollment->enrollment_date }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection