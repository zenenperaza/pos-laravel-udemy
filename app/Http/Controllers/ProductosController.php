<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
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
        $categorias = DB::table('categorias')->orderBy('nombre')->get();

        $productos = DB::table('productos')
        ->leftJoin('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombre as categoria_nombre')
        ->get(); 

        return view('modulos.productos.Productos', compact('categorias', 'productos'));
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
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditarProducto($id_producto)
    {
        $producto = Productos::find($id_producto);

        return response()->json($producto);


    }

    /**
     * Update the specified resource in storage.
     */
    public function ActualizarProducto(Request $request)
    {
        $datos = request();

        $producto = Productos::find($request->id);

        if(request('imagen')){

            $path = storage_path('app/public/'. $producto->imagen);
            unlink($path);

            $rutaImagen = $datos["imagen"]->store('productos', 'public');

        } else {

            $rutaImagen = $producto->imagen;
        }

        Productos::where('id', $datos["id"])
        ->update([
            'id_categoria'=>$datos["id_categoria"],
            'codigo'=>$datos["codigo"],
            'descripcion'=>$datos["descripcion"],
            'stock'=>$datos["stock"],
            'precio_compra'=>$datos["precio_compra"],
            'precio_venta'=>$datos["precio_venta"],
            'imagen'=>$rutaImagen,
        ]);

        return redirect('Productos')->with('success', 'El producto ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function EliminarProducto($id_producto)
    {
        $producto = Productos::find($id_producto);

        if($producto->imagen != ''){

            $path = storage_path('app/public/' . $producto->imagen);
            unlink($path);
        }

        $producto->delete();
        
        return redirect('Productos');

    }

    
    public function GenerarCodigo($id_categoria)
    {
        
        $producto = Productos::where('id_categoria', $id_categoria)->orderBy('id', 'desc')->first();

        if ($producto == null) {
            $respuesta = 0;
        } else {
            $respuesta = $producto;
        }

        return response()->json($respuesta);
     
        
    }

    public function AgregarProducto(Request $request)
    {
       $datos = request();
       
       if (request('imagen')) {
        $rutaImg = $datos["imagen"]->store('productos', 'public');
       } else {
        $rutaImg = " ";
       }

       Productos::create([
        'id_categoria' => $datos["id_categoria"],
        'codigo' => $datos["codigo"],
        'descripcion' => $datos["descripcion"],
        'stock' => $datos["stock"],
        'precio_compra' => $datos["precio_compra"],
        'precio_venta' => $datos["precio_venta"],
        'imagen' => $rutaImg,
        'ventas' => 0,
       ]);

       return redirect('Productos')->with('success', 'Producto agregado satisfactoriamente');
    }
}
