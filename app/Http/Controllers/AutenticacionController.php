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

        if(!isset($usuario)){
            return back()->withErrors([
                'email' => 'No existen el usuario al que desea acceder, solicite un usuario al administrador del sistema.',
            ]);
        }


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
                    ->select('u.id', 'u.name', 'u.email', 'u.estado', 'r.rol', 'u.img')
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
            
            $data = $request->all();
            if(isset($data['perfil'])){
                $pathFile = "/temp/perfiles/";
                $pathSave = "temp/perfiles/";
                $filename = 'img_perfil_'.time().'.'.$request->perfil->extension();
                $data['perfil'] = $pathFile.$filename;
                $request->perfil->move(public_path($pathSave), $filename);

                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'img' => $data['perfil'],
                    'rol_type' => $data['rol']
                ]);

                return to_route('usuarios.index')->with('success', 'Se ha creado el usuario');
            }

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol_type' => $data['rol']
            ]);


            
            return to_route('usuarios.index')->with('success', 'Se ha creado el usuario');
        }else{
            return back()->withErrors([
                'password' => 'Las contraseñas no coinciden.',
            ]);
        }

    }

    public function edit($id){
        $usuario = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->pluck('id', 'rol');
        return view('auth.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id){

        $usuario = User::where('id', $id)->first();
        
        //MANIPULANDO LA IMAGEN
        $data = $request->all();
        if(isset($data['perfil'])){
            $pathFile = "/temp/perfiles/";
            $pathSave = "temp/perfiles/";
            $filename = 'img_perfil_'.time().'.'.$request->perfil->extension();
            $data['perfil'] = $pathFile.$filename;
            $request->perfil->move(public_path($pathSave), $filename);
        }

        //REGISTRANDO LA INFORMACION
        $dataActualizada = [
            'name' => $request->name,
            'email' => $request->email,
            'rol_type' => $request->rol_type,
        ];

        if(!empty($request->perfil)){
            $dataActualizada['img'] = $data['perfil'];
        }

        if (!empty($request->password) && $request->password === $request->password2) {
            $dataActualizada['password'] = Hash::make($request->password);
        } elseif (!empty($request->password) && $request->password !== $request->password2) {
            return back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }

        $usuario->update($dataActualizada);

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

