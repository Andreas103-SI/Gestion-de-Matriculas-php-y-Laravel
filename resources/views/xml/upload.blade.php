<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload XML File</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Upload Student XML File</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('xml.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="xml_file">XML File</label>
            <input type="file" id="xml_file" name="xml_file" accept=".xml" required>
            @error('xml_file')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Upload and Create Students</button>
    </form>
</body>
</html>
