<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gestión de Matrículas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        
        <!-- Custom Styles -->
        <style>
            :root {
                --primary-color: #2563eb;
                --secondary-color: #1e40af;
                --accent-color: #3b82f6;
                --background-color: #f8fafc;
                --text-color: #1e293b;
            }
            
            body {
                background-color: var(--background-color);
                color: var(--text-color);
                font-family: 'Figtree', sans-serif;
            }
            
            .navbar {
                background-color: white !important;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 1rem 0;
            }
            
            .navbar-brand {
                font-weight: 600;
                color: var(--primary-color) !important;
                font-size: 1.5rem;
            }
            
            .nav-link {
                color: var(--text-color) !important;
                font-weight: 500;
                padding: 0.5rem 1rem !important;
                transition: all 0.3s ease;
            }
            
            .nav-link:hover {
                color: var(--primary-color) !important;
            }
            
            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }
            
            .btn-primary:hover {
                background-color: var(--secondary-color);
                border-color: var(--secondary-color);
            }
            
            .card {
                border: none;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                transition: transform 0.2s ease;
            }
            
            .card:hover {
                transform: translateY(-2px);
            }
            
            .alert {
                border: none;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
            
            .container {
                max-width: 1200px;
                padding: 2rem 1rem;
            }
            
            .table {
                background-color: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
            
            .table thead th {
                background-color: var(--primary-color);
                color: white;
                font-weight: 500;
                border: none;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    Gestión de Matrículas
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('students.index') }}">
                                <i class="bi bi-people me-1"></i>Estudiantes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">
                                <i class="bi bi-book me-1"></i>Cursos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('enrollments.index') }}">
                                <i class="bi bi-pencil-square me-1"></i>Matrículas
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-gear me-2"></i>Perfil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="bg-white border-top mt-5 py-4">
            <div class="container text-center text-muted">
                <small>&copy; {{ date('Y') }} Sistema de Gestión de Matrículas. Todos los derechos reservados.</small>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
