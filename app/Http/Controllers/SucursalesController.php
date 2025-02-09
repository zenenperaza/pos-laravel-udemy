<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;
use App\Models\User;



class SucursalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(auth()->user()->rol != 'Admin'){

            return redirect('Inicio');

        }

        $sucursales = Sucursales::all();

        return view('modulos.users.Sucursales', compact('sucursales'));
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
        Sucursales::create([

            'nombre'=>$request->nombre,
            'estado'=>1

        ]);

        return redirect('Sucursales')->with('success', 'La Sucursal ha sido Agregada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sucursales $sucursales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_sucursal)
    {
        $sucursal = Sucursales::find($id_sucursal);

        return response()->json($sucursal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        Sucursales::where('id', $request->id)->update(['nombre'=>$request->nombre]);

        return redirect('Sucursales')->with('success', 'La Sucursal ha sido actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sucursales $sucursales)
    {
        //
    }

    public function CambiarEstado($estado, $id_sucursal){

        Sucursales::find($id_sucursal)->update(['estado'=>$estado]);

        return redirect('Sucursales');
    }
}
