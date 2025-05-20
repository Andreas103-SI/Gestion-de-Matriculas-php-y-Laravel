
<form action="{{ route('students.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por nombre, apellidos o correo" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
        @if (request('search'))
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Limpiar</a>
        @endif
    </div>
    @error('search') <div class="text-danger">{{ $message }}</div> @enderror
</form>
