<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    protected $validInvitationCode = '123456789'; // Código estático

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'invitation_code' => 'required|string',
        ]);

        // Validar código de invitación
        if ($request->invitation_code !== $this->validInvitationCode) {
            return back()->withErrors([
                'invitation_code' => 'El código de invitación no es válido.',
            ])->onlyInput('invitation_code');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'invitation_code' => $request->invitation_code,
        ]);

        return redirect('/login')->with('success', 'Registro exitoso. Por favor inicia sesión.');
    }
}