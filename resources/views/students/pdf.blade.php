<!-- filepath: resources/views/students/pdf.blade.php -->
<h1>Certificado de Estudiante</h1>
<ul>
    <li><strong>Nombre:</strong> {{ $fields['first_name'] }} {{ $fields['last_name'] }}</li>
    <li><strong>DNI/NIE:</strong> {{ $fields['dni_nie'] }}</li>
    <li><strong>Email:</strong> {{ $fields['email'] }}</li>
    <li><strong>Teléfono:</strong> {{ $fields['phone'] }}</li>
    <li><strong>Fecha de Nacimiento:</strong> {{ $fields['birth_date'] }}</li>
    <li><strong>Discapacidad:</strong> {{ $fields['disability'] }}</li>
    <li><strong>Dirección:</strong> {{ $fields['address'] }}</li>
</ul>
