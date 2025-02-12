<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Sucursales;
use App\Models\Ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function VerVentas()
    {
        $sucursales = Sucursales::where('estado', 1)->get();

        $clientes = Clientes::where('estado', 1)->get();

        $ventas = Ventas::all();    

        return view('modulos.Ventas.Ventas', compact('sucursales', 'clientes', 'ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CrearVentas(Request $request)
    {
        $datos = request();

        $UltimaVenta = Ventas::orderBy('id', 'desc')->where('id_sucursal', $datos["id_sucursal"])->first();

        if($UltimaVenta == null){
            $codigo = $datos["id_sucursal"]*10000;
        }else{
            $codigo = $UltimaVenta["codigo"] + 1;
        }
        

        // dd($datos["id_sucursal"]);

        Ventas::create([
    
            'id_sucursal' => $datos["id_sucursal"],
            'id_vendedor' => $datos["id_vendedor"],   
            'id_cliente' => $datos["id_cliente"],    
            'codigo' => $codigo,
            'impuesto' => 0,
            'neto' => 0,
            'total' => 0,
            'metodo_pago' => '',
            'estado' => 'Creada'
        ]);

        $nuevaVenta = Ventas::orderBy('id', 'desc')->first();

        return redirect('Venta/'.$nuevaVenta["id"]);

    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $ventas)
    {
        //
    }

    public function AdminstrarVenta($id_venta)
    {
        $venta = Ventas::find($id_venta);
        $productos = Productos::all();

        return view('modulos.Ventas.Venta', compact('venta', 'productos'));
    }
}
