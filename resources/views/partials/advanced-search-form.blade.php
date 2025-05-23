<form action="{{ route('students.index') }}" method="GET" class="mb-4">
    <div class="form-group ">
        <div class="col-md-4">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ request('first_name') }}" placeholder="Ej. Ana">
        </div>
        <div class="col-md-4">
            <label for="last_name" class="form-label">Apellidos</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ request('last_name') }}" placeholder="Ej. García">
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Ej. ana@example.com">
        </div>
        <div class="col-md-4">
            <label for="dni_nie" class="form-label">DNI/NIE</label>
            <input type="text" name="dni_nie" id="dni_nie" class="form-control" value="{{ request('dni_nie') }}" placeholder="Ej. 12345678Z">
        </div>
        <div class="col-md-4">
            <label for="disability" class="form-label">Discapacidad</label>
            <select name="disability" id="disability" class="form-control">
                <option value="" {{ request('disability') === null ? 'selected' : '' }}>Todos</option>
                <option value="1" {{ request('disability') === '1' ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ request('disability') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </div>
</form>