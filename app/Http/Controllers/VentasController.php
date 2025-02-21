<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Sucursales;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function AgregarProductoVenta(Request $request)
    {
        // dd($request->idVenta);
        $producto = Productos::find($request->idProducto);

    // dd($producto);

        DB::table('venta_productos')->insert([
            'id_venta' => $request->idVenta,
            'id_producto' => $producto->id,
            'cantidad' => 1,
            'precio' => $producto->precio_venta
        ]);

        Ventas::find($request->idVenta)->update([
            'estado' => 'En Proceso'
        ]);

        return response()->json([
            
            'id' => $producto->id,
            'descripcion' => $producto->descripcion,
            'stock' => $producto->stock,
            'cantidad' => 1,
            'precio_venta' => $producto->precio_venta

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CargarProductosVenta($id_venta)
    {
        $productos = DB::table('venta_productos')
        ->join('productos', 'venta_productos.id_producto', '=', 'productos.id')
        ->where('venta_productos.id_venta', $id_venta)
        ->get();

        return response()->json(['productos' => $productos]);
    }



    public function AdminstrarVenta($id_venta)
    {
        $venta = Ventas::find($id_venta);

        $productos = Productos::leftJoin('venta_productos', function($join) use ($id_venta){
            $join->on('productos.id', '=', 'venta_productos.id_producto')
            ->where('venta_productos.id_venta', $id_venta);
        })->select('productos.*', 'venta_productos.id as en_venta')
        ->get();

        // dd($productos);

        return view('modulos.Ventas.Venta', compact('venta', 'productos'));
    }


    public function QuitarProductoVenta(Request $request)
    {
        DB::table('venta_productos')->where('id_venta', $request->idVenta)
        ->where('id_producto', $request->idProducto)
        ->delete();


    }

    public function FinalizarVenta(Request $request)
    {
      
        $idVenta = $request->idVenta;
        $productos = $request->productos;
        $pagos = $request->pago[0];

        foreach($productos as $productoData){

            $producto = Productos::find($productoData['id']);

            DB::table('venta_productos')->where('id_venta', $idVenta)
            ->where('id_producto', $productoData['id'])
            ->update([
                'cantidad' => $productoData['cantidad'],
                'precio' => $productoData['precio']
            ]);

            $nuevoStock = $producto->stock - $productoData['cantidad'];

            $producto->stock = $nuevoStock;

            $nuevoProductoVenta = $producto->ventas + 1;

            $producto->ventas = $nuevoProductoVenta;

            $producto->save();
        }

        $venta = Ventas::find($idVenta);
        $venta->impuesto = $pagos['impuesto'];
        $venta->neto = $pagos['neto'];
        $venta->total = $pagos['total'];
        $venta->metodo_pago = $pagos['metodo_pago'];
        $venta->estado = 'Finalizada';

        $venta->save();
    }



}
