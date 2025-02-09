<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::where('estado', 1)->get();

        return view('modulos.clientes.Clientes', compact('clientes'));
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
        $validarDocumento = request()->validate([
            'documento'=>['unique:clientes']
        ]); 

        $datos = request();        

        Clientes::create([
            'cliente'=>$datos["cliente"],
            'email'=>$datos["email"],
            'direccion'=>$datos["direccion"],
            'telefono'=>$datos["telefono"],
            'fecha_nac'=>$datos["fecha_nac"],
            'documento'=>$validarDocumento["documento"],
            'estado'=>1,
        ]);

        return redirect('Clientes')->with('success', 'El cliente fue agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_cliente)
    {
        $cliente = Clientes::find($id_cliente);

        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }

    public function ValidarDocumento(Request $request)
    {
        $cliente = Clientes::where('documento', $request->documento)->exists();

        if ($cliente == null) {
            $respuesta = true;
        } else {
            $respuesta = false;
        }

        return response()->json($respuesta);
    }
}
