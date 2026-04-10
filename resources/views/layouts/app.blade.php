<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TrackedLab')</title>
    
    <!-- Fuente Inter (Google Fonts) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 (solo lo esencial) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Layout con sidebar fijo */
        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar izquierdo */
        .sidebar {
            width: 260px;
            background-color: #fafafa;
            border-right: 1px solid #eaeaea;
            padding: 2rem 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-logo {
            padding: 0 1rem 2rem 1rem;
            border-bottom: 1px solid #eaeaea;
            margin-bottom: 2rem;
        }
        
        .sidebar-logo h3 {
            font-weight: 600;
            font-size: 1.25rem;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.01em;
        }
        
        .sidebar-logo p {
            font-size: 0.75rem;
            color: #8a8a8a;
            margin: 0.25rem 0 0 0;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4a4a4a;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        
        .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            color: #8a8a8a;
            margin-right: 0.75rem;
        }
        
        .nav-link:hover {
            background-color: #f0f0f0;
            color: #1a1a1a;
        }
        
        .nav-link:hover i {
            color: #3b82f6;
        }
        
        .nav-link.active {
            background-color: #f0f0f0;
            color: #1a1a1a;
            font-weight: 600;
        }
        
        .nav-link.active i {
            color: #3b82f6;
        }
        
        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 2rem;
            background-color: #ffffff;
        }
        
        /* Header superior (dentro del main) */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eaeaea;
        }
        
        .content-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }
        
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1a1a1a;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            background-color: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a4a4a;
            border: 1px solid #eaeaea;
        }
        
        /* Cards minimalistas */
        .card-minimal {
            background: #ffffff;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.2s;
        }
        
        .card-minimal:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.02);
            border-color: #d0d0d0;
        }
        
        /* Tablas */
        .table-minimal {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }
        
        .table-minimal th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #8a8a8a;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eaeaea;
        }
        
        .table-minimal td {
            padding: 1rem;
            background-color: #fafafa;
            border-radius: 8px;
            color: #1a1a1a;
            font-size: 0.9rem;
        }
        
        /* Badges */
        .badge-minimal {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-success {
            background-color: #ecfdf3;
            color: #067647;
            border: 1px solid #abefc6;
        }
        
        .badge-warning {
            background-color: #fffaeb;
            color: #b54708;
            border: 1px solid #fedf89;
        }
        
        .badge-danger {
            background-color: #fef3f2;
            color: #b42318;
            border: 1px solid #fecdca;
        }
        
        /* Botones minimalistas */
        .btn-minimal {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border: 1px solid #eaeaea;
            background: white;
            color: #1a1a1a;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-minimal:hover {
            background-color: #f5f5f5;
            border-color: #d0d0d0;
        }
        
        .btn-minimal-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: white;
        }
        
        .btn-minimal-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
            color: white;
        }
        
        /* Formularios minimalistas */
        .form-minimal {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        
        .form-minimal:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.05);
        }
        
        /* Grid para estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            background: #fafafa;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 1.25rem;
        }
        
        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #8a8a8a;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.2;
        }
        
        /* Links */
        a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        a:hover {
            color: #2563eb;
        }
        
        /* Alertas minimalistas */
        .alert-minimal {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid;
        }
        
        .alert-success {
            background-color: #ecfdf3;
            border-color: #abefc6;
            color: #067647;
        }
        
        .alert-danger {
            background-color: #fef3f2;
            border-color: #fecdca;
            color: #b42318;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .app-wrapper {
                flex-direction: column;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app-wrapper">
        <!-- Sidebar Izquierdo -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <h3>TrackedLab</h3>
                <p>Gestión de reactivos</p>
            </div>
            
            @auth
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reactivos.index') }}" class="nav-link {{ request()->routeIs('reactivos.index') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span>Reactivos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reactivos.create') }}" class="nav-link {{ request()->routeIs('reactivos.create') ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        <span>Registrar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movimientos.index') }}">
                        <i class="fas fa-exchange-alt"></i> Movimientos
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link" style="width: 100%; text-align: left; border: none; background: none;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
            @endauth
        </div>

        <!-- Contenido Principal -->
        <div class="main-content">
            @auth
            <div class="content-header">
                <h1>@yield('title', 'Dashboard')</h1>
                <div class="user-dropdown">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Alertas -->
            @if(session('success'))
                <div class="alert-minimal alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-minimal alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-minimal alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>