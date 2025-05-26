<!-- filepath: resources/views/students/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Información del Estudiante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }
        .field {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #666;
            width: 150px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header">Información del Estudiante</div>

    <div class="field">
        <span class="label">Nombre:</span>
        {{ $fields['first_name'] }} {{ $fields['last_name'] }}
    </div>

    <div class="field">
        <span class="label">DNI/NIE:</span>
        {{ $fields['dni_nie'] }}
    </div>

    <div class="field">
        <span class="label">Email:</span>
        {{ $fields['email'] ?? 'No disponible' }}
    </div>

    <div class="field">
        <span class="label">Teléfono:</span>
        {{ $fields['phone'] ?? 'No disponible' }}
    </div>

    <div class="field">
        <span class="label">Fecha de Nacimiento:</span>
        {{ $fields['birth_date'] }}
    </div>

    <div class="field">
        <span class="label">Discapacidad:</span>
        {{ $fields['disability'] }}
    </div>

    <div class="field">
        <span class="label">Dirección:</span>
        {{ $fields['address'] ?? 'No disponible' }}
    </div>
</body>
</html>
