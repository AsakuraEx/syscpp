<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{

    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->only('email','password');

        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con los registros de usuario del sistema',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function registrarse()
    {
        return view('auth.register');
    }

    public function guardarRegistro(Request $request)
    {
        if($request->password === $request->password2){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_type' => '3'
            ]);
            return redirect('/login')->with('success', 'Se ha creado el usuario, por favor inicia sesion');
        }

        return back()->withErrors([
            'password' => 'Las contraseñas no coinciden',
        ]);

    }
}
