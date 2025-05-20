@php
    // Parámetros por defecto
    $model = $model ?? null; // Objeto del modelo (ej. $student)
    $isEdit = $isEdit ?? false; // true para edit, false para create
@endphp

<div class="mb-3">
    <label for="first_name" class="form-label">Nombre</label>
    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $isEdit ? $model->first_name : '') }}" required>
    @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Apellidos</label>
    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $isEdit ? $model->last_name : '') }}" required>
    @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="dni_nie" class="form-label">DNI/NIE</label>
    <input type="text" name="dni_nie" id="dni_nie" class="form-control" value="{{ old('dni_nie', $isEdit ? $model->dni_nie : '') }}" required>
    @error('dni_nie') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Correo Electrónico</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $isEdit ? $model->email : '') }}" required>
    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Teléfono</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $isEdit ? $model->phone : '') }}">
    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="address" class="form-label">Dirección</label>
    <textarea name="address" id="address" class="form-control">{{ old('address', $isEdit ? $model->address : '') }}</textarea>
    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $isEdit && $model->birth_date ? $model->birth_date->format('Y-m-d') : '') }}" required>
    @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3 form-check">
    <input type="checkbox" name="disability" id="disability" class="form-check-input" value="1"
    {{ old('disability', $isEdit ? $model->disability : false) ? 'checked' : '' }}>
    <label for="disability" class="form-check-label">¿Tiene Discapacidad?</label>
    @error('disability') <div class="text-danger">{{ $message}} </div>@enderror
</div>