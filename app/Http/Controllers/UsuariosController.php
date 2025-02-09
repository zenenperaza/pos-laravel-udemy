<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Sucursales;

class UsuariosController extends Controller
{    

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function PrimerUsuario(){
    //     User::create([
    //         'name'=>'Zenen Peraza',
    //         'email'=>'peraza@outlook.com',
    //         'foto'=>'',
    //         'estado'=>1,
    //         'ultimo_login'=>'',
    //         'rol'=>'Admin',
    //         'id_sucursal'=>0,
    //         'password'=>Hash::make('123'),
    //     ]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(auth()->user()->rol != 'Admin'){
            return redirect('Inicio');
        }

        $usuarios = User::all();
        $sucursales = Sucursales::where('estado', 1)->get();

       return view('modulos.users.Usuarios', compact('usuarios', 'sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validarEmail = request()->validate([
            'email'=>['unique:users']
        ]);

        $datos = request();

        if($datos["rol"] == 'Admin'){
            $id_sucursal = 0;
        } else {
            $id_sucursal = $datos["id_sucursal"];
        }

        User::create([
            'name'=>$datos["name"],
            'email'=>$validarEmail["email"],
            'id_sucursal'=>$id_sucursal,
            'foto'=>'',
            'password'=>Hash::make($datos["password"]),
            'estado'=>1,
            'ultimo_login'=>null,
            'rol'=>$datos["rol"],
        ]);

        return redirect('Usuarios')->with('success', 'Usuario ingresado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_usuario)
    {
        $usuario = User::find($id_usuario);

        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        if(request('password')){

            $validarPass = request()->validate([
                'password'=>["string", "min:3"]
            ]);

            $pass = true;

        } else {

            $pass = false;
        }



        $datos = request();

        if($datos["rol"] == 'Admin'){
            $id_sucursal = 0;
        } else {
            $id_sucursal = $datos["id_sucursal"];
        }

        $User = User::find($datos["id"]);

        $User->name = $datos["name"];
        $User->email = $datos["email"];
        $User->rol = $datos["rol"];
        $User->id_sucursal = $id_sucursal;

        if($pass != false){
            $User->password = Hash::make($datos["password"]);
        }

        $User->save();

        return redirect('Usuarios')->with('success', 'Usuario actualizado satisfasctoriamente');


    }

    /**
     * 
     */
    public function CambiarEstado($id_usuario, $estado)
    {
        User::find($id_usuario)->update(['estado'=>$estado]);
        return redirect('Usuarios');
    }

    /**
     * 
     */
    public function ActualizarMisDatos(Request $request)
    {
        if (auth()->user()->email != request('email')) {
            
            if (request('password')) {
                
                $datos = request()->validate([
                    'name'=> ['required','string','max:50'],
                    'email'=> ['required','email','unique:users'],
                    'password'=> ['required','string','min:3'],
                ]);
            } else {

                $datos = request()->validate([
                    'name'=> ['required','string','max:50'],
                    'email'=> ['required','email','unique:users'],
                ]);
            }
        } else {

            if (request('password')) {
                
                $datos = request()->validate([
                    'name'=> ['required','string','max:50'],
                    'email'=> ['required','email'],
                    'password'=> ['required','string','min:3'],
                ]);
            } else {

                $datos = request()->validate([
                    'name'=> ['required','string','max:50'],
                    'email'=> ['required','email'],
                ]);
            }

        }

        if (request('fotoPerfil')) {
            
            if (auth()->user()->foto != '') {
                
                $path = storage_path('app/public/'.auth()->user()->foto);
                unlink($path);
            }

            $rutaImg = $request['fotoPerfil']->store('users', 'public');

        } else {

            $rutaImg = auth()->user()->foto;
        }

        if(isset($datos["password"])){

            DB::table('users')->where('id', auth()->user()->id)->update([

                'name'=>$datos["name"],
                'email'=>$datos["email"],
                'foto'=>$rutaImg,
                'password'=>Hash::make($datos["password"])
            ]);

        } else {
            DB::table('users')->where('id', auth()->user()->id)->update([

                'name'=>$datos["name"],
                'email'=>$datos["email"],
                'foto'=>$rutaImg,
            ]);
        }

        return redirect('Mis-Datos');

        

    }

    public function VerificarUsuario(Request $request)
    {

        $user = User::find($request->id);

        if($request->email != $user["email"]){

            $emailExistente = User::where('email', $request->email)->exists();

            if($emailExistente != null){

                $verificacion = false;

            } else {

                $verificacion = true;
            }
        } else {

            $verificacion = true;
        }

        return response()->json(['emailVerificacion' => $verificacion]);

    }

    public function destroy($id_usuario){

        $usuario = User::find($id_usuario);

        if($usuario->foto != ''){

            $path = storage_path('app/public/' . $usuario->foto);
            unlink($path);
        }

        User::destroy($id_usuario);

        return redirect('Usuarios');

    }
}
