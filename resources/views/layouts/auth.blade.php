<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventario Lab')</title>
    
    <!-- Fuente Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
        }
        
        .auth-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo i {
            font-size: 2.5rem;
            color: #3b82f6;
            background: #f0f7ff;
            padding: 1rem;
            border-radius: 16px;
        }
        
        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .auth-subtitle {
            color: #8a8a8a;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-minimal {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        
        .form-minimal:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.05);
        }
        
        .btn-minimal-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        
        .btn-minimal-primary:hover {
            background-color: #2563eb;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #eaeaea;
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .form-control {
            border: 1px solid #eaeaea;
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #eaeaea;
        }
        
        .alert-minimal {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background-color: #ecfdf3;
            border: 1px solid #abefc6;
            color: #067647;
        }
        
        .alert-danger {
            background-color: #fef3f2;
            border: 1px solid #fecdca;
            color: #b42318;
        }
        
        a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        a:hover {
            color: #2563eb;
            text-decoration: underline;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">
                <i class="fas fa-flask"></i>
            </div>
            <div class="auth-title">Inventario Lab</div>
            <div class="auth-subtitle">@yield('subtitle', 'Sistema de Gestión de Reactivos')</div>
            
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
    @stack('scripts')
</body>
</html>