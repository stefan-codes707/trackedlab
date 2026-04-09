<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReactivoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta pública para QR (DEBE IR PRIMERO)
Route::get('/qr/{qr_code}', [ReactivoController::class, 'publicShow'])->name('reactivos.public');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);  // <-- CORREGIDO

// Redirección de la raíz
Route::get('/', function () {
    return redirect('/login');
});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reactivos (CRUD completo)
    Route::resource('reactivos', ReactivoController::class);
    Route::get('/reactivos/{reactivo}/download-qr', [ReactivoController::class, 'downloadQR'])->name('reactivos.download-qr');
    Route::get('/scan-qr', [ReactivoController::class, 'scanQR'])->name('reactivos.scan');
    Route::post('/verify-qr', [ReactivoController::class, 'verifyQR'])->name('reactivos.verify-qr');
});