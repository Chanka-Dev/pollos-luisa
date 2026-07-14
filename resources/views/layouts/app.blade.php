<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pollos Luisa') - Panel de Gestión</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --primary-color: #ff5e3a;
            --primary-hover: #ff451b;
            --secondary-color: #4f46e5;
            --secondary-hover: #4338ca;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --glass-blur: blur(12px);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(255, 94, 58, 0.1) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* Navigation Header */
        header {
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--card-border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), #ff9e80);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-muted);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.05);
        }

        /* Main Wrapper */
        main {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Card Container (Glassmorphism) */
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--card-border);
            padding-bottom: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-main);
        }

        /* UI Alert components */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            border: 1px solid transparent;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        /* Buttons styling */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary-color);
            color: #ffffff;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: var(--secondary-hover);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-main);
            border: 1px solid var(--card-border);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--text-muted);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            background: var(--accent-red);
            color: #ffffff;
        }

        /* Modern Tables */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--card-border);
        }

        td {
            padding: 1.2rem 1rem;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-main);
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.01);
        }

        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 94, 58, 0.15);
        }

        .error-message {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: block;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid var(--card-border);
            color: var(--text-muted);
            font-size: 0.85rem;
            background: rgba(11, 15, 25, 0.5);
        }

        /* Utility classes */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-muted);
        }

        .badge-accent {
            background: rgba(79, 70, 229, 0.2);
            color: #a5b4fc;
        }
    </style>
</head>
<body>

    <header>
        <div class="nav-container">
            <a href="{{ url('/') }}" class="logo">
                🍗 Pollos Luisa
            </a>
            <nav class="nav-links">
                <a href="{{ route('empleados.index') }}" class="nav-link {{ Request::is('empleados*') ? 'active' : '' }}">
                    Empleados
                </a>
                <a href="{{ route('turnos.index') }}" class="nav-link {{ Request::is('turnos*') ? 'active' : '' }}">
                    Turnos
                </a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Alerts logic -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Pollos Luisa - Sistema de Control y Turnos. Todos los derechos reservados.
    </footer>

</body>
</html>
