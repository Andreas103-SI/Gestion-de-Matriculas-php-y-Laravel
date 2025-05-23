@php
    // Parámetros por defecto
    $model = $model ?? null; // Objeto del modelo (ej. $course)
    $isEdit = $isEdit ?? false; // true para edit, false para create
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $isEdit ? $model->name : '') }}" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $isEdit ? $model->description : '') }}</textarea>
    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="start_date" class="form-label">Fecha de Inicio</label>
    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $isEdit && $model->start_date ? $model->start_date->format('Y-m-d\TH:i') : '') }}" required>
    @error('start_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="end_date" class="form-label">Fecha de Fin</label>
    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $isEdit && $model->end_date ? $model->end_date->format('Y-m-d\TH:i') : '') }}" required>
    @error('end_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="capacity" class="form-label">Capacidad</label>
    <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $isEdit ? $model->capacity : '') }}" required>
    @error('capacity') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="location" class="form-label">Ubicación</label>
    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $isEdit ? $model->location : '') }}">
    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="price" class="form-label">Precio</label>
    <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $isEdit ? $model->price : '') }}" step="0.01" required>
    @error('price') <div class="text-danger">{{ $message }}</div> @enderror
</div>