@extends('layouts.auth')

@section('title', 'Registro')
@section('subtitle', 'Crea una cuenta con código de invitación')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    
    <div style="margin-bottom: 1rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Nombre Completo</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
        </div>
        @error('name')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 1rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" required>
        </div>
        @error('email')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 1rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Nombre de Usuario</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-at"></i></span>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                   value="{{ old('username') }}" required>
        </div>
        @error('username')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 1rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Código de Invitación</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
            <input type="text" name="invitation_code" class="form-control @error('invitation_code') is-invalid @enderror" 
                   value="{{ old('invitation_code') }}" required placeholder="123456789">
        </div>
        @error('invitation_code')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 1rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Contraseña</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        </div>
        @error('password')
            <span style="color: #b42318; font-size: 0.75rem; margin-top: 0.25rem; display: block;">{{ $message }}</span>
        @enderror
    </div>
    
    <div style="margin-bottom: 2rem;">
        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Confirmar Contraseña</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
    </div>
    
    <button type="submit" class="btn-minimal-primary">
        <i class="fas fa-user-plus"></i>
        Registrarse
    </button>
    
    <div style="text-align: center; margin-top: 1.5rem;">
        <a href="{{ route('login') }}">
            ¿Ya tienes cuenta? Inicia sesión
        </a>
    </div>
</form>
@endsection