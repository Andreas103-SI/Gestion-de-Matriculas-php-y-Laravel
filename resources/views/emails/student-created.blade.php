<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Creación</title>
</head>
<body>
    <h1>¡Bienvenido, {{ $student->first_name }} {{ $student->last_name }}!</h1>
    <p>Tu cuenta de alumno ha sido creada exitosamente.</p>
    <p><strong>DNI/NIE:</strong> {{ $student->dni_nie }}</p>
    <p><strong>Correo:</strong> {{ $student->email }}</p>
    <p>Si tienes alguna duda, contáctanos.</p>

</body>
</html>
