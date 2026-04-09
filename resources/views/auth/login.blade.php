@extends('layouts.auth')

@section('title', 'Iniciar Sesión')
@section('subtitle', 'Ingresa tus credenciales')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <div style="margin-bottom: 1.5rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Usuario</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                   value="{{ old('username') }}" required autofocus>
        </div>
        @error('username')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 2rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Contraseña</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>
        @error('password')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <button type="submit" class="btn-minimal-primary">
        <i class="fas fa-sign-in-alt"></i>
        Iniciar Sesión
    </button>
    
    <div style="text-align: center; margin-top: 1.5rem;">
        <a href="{{ route('register') }}">
            ¿No tienes cuenta? Regístrate
        </a>
    </div>
</form>
@endsection