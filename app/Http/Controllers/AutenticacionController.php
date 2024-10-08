<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $usuario = DB::table('users')->where('email', $request->email)->first();

        if($usuario->estado === 0){
            return back()->withErrors([
                'email' => 'El usuario esta deshabilitado',
            ]);
        }

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

    public function index(){
        $usuarios = DB::table('users as u')
                    ->join('roles as r', 'u.rol_type', '=', 'r.id')
                    ->select('u.id', 'u.name', 'u.email', 'u.estado', 'r.rol')
                    ->paginate(10);

        $roles = DB::table('roles')->pluck('id', 'rol');
        return view('auth.index', compact('usuarios', 'roles'));
    }

    public function create(){
        $roles = DB::table('roles')->pluck('id', 'rol');
        return view('auth.create', compact('roles'));
    }

    public function store(Request $request){
        //dd(Hash::check($request->password, "$2y$10$3btpOtSg2luj2DZnMSgweuDkWxwjef0yzZjdA4nkDeDWQk4gC6RAK"));
        if($request->password === $request->password2){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_type' => $request->rol
            ]);
        }

        return to_route('usuarios.index')->with('success', 'Se ha creado el usuario');

    }

    public function edit($id){
        $usuario = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->pluck('id', 'rol');
        return view('auth.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id){

        $usuario = User::where('id', $id)->first();
        if($request->password == null){
            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_type' => $request->rol_type
            ]);
        }elseif ($request->password === $request->password2){
            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_type' => $request->rol_type
            ]);
        }else{
            return back()->withErrors([
                'password' => 'Las contraseñas no coinciden',
            ]);
        }

        return to_route('usuarios.index')->with('success', 'Se ha actualizado el usuario');
    }

    public function cambiarEstado($id){
        $usuario = User::where('id', $id)->first();
        if($usuario->estado == 1){
            $usuario->update([
                'estado' => 0
            ]);
        }else{
            $usuario->update([
                'estado' => 1
            ]);
        }

        return to_route('usuarios.index')->with('success', 'Actualización de estado exitoso');
    }

    public function buscarUsuario(Request $request)
    {

        $usuarios = DB::table('users as u')
            ->join('roles as r', 'u.rol_type', '=', 'r.id')
            ->select('u.id', 'u.name', 'u.email', 'u.estado', 'r.rol');

        if($request->usuario != null){
            $usuarios->where('u.name', 'like', '%'.$request->usuario.'%');
        }

        if($request->estado != null){
            $usuarios->where('estado', $request->estado);
        }

        if($request->rol != null){
            $usuarios->where('rol_type', $request->rol);
        }

        $usuarios = $usuarios->paginate(10);

        $roles = DB::table('roles')->pluck('id', 'rol');

        return view('auth.index', compact('usuarios', 'roles'));
    }

    public function password()
    {
        return view('auth.password');
    }

    public function changePassword(Request $request)
    {
        $usuario = User::where('id', Auth::user()->id)->first();
        if($request->oldpassword != null){
            if(Hash::check($request->oldpassword, Auth::user()->password)){
                if($request->password === $request->password2){
                    $usuario->update([
                        'password' => Hash::make($request->password)
                    ]);
                    return to_route('home')->with('success', 'Se ha realizado el cambio de contraseña');
                }
                return back()->withErrors([
                    'password' => 'Las contraseñas introducidas no coinciden',
                ]);
            }
            return back()->withErrors([
                'password' => 'Las credenciales no coinciden con los registros de usuario del sistema',
            ]);
        }


    }
}

