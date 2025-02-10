<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
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

        return view('modulos.Ventas.Ventas', compact('sucursales', 'clientes'));
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
}
