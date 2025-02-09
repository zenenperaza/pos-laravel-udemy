<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
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
        $categorias = DB::table('categorias')->orderBy('nombre', 'asc')->get();

        return view('modulos.productos.Categorias', compact('categorias'));
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
        DB::table('categorias')->insert(['nombre'=>$request->nombre]);

        return redirect('Categorias')->with('success', 'La categoria ha sido Agregada');
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
    public function edit($id_categoria)
    {
        $categoria = DB::table('categorias')->where('id', $id_categoria)->first();

        return response()->json($categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::table('categorias')->where('id', $request->id)->update(['nombre'=>$request->nombre]);

        return redirect('Categorias')->with('success', 'La Categoria ha sido Actualizada satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_categoria)
    {
        
        DB::table('categorias')->where('id', $id_categoria)->delete();
        
        return redirect('Categorias');

    }
    
}
