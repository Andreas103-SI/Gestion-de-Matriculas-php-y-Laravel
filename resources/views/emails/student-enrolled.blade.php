<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Matrícula</title>
</head>
<body>
    <h1>¡Hola, {{ $student->first_name }} {{ $student->last_name }}!</h1>
    <p>Te has matriculado exitosamente en el curso: {{ $course->name ?? 'Curso sin nombre' }}.</p>
    <p><strong>Fecha de inicio:</strong> {{ $course->start_date ? $course->start_date->format('d/m/Y') : 'Sin fecha' }}</p>
    <p>¡Disfruta tu aprendizaje!</p>
</body>
</html>