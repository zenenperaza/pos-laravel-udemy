<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = DB::table('categorias')->count();
        $clientes = Clientes::where('estado', 1)->count();
        $productos = Productos::all()->count();

        if(auth()->user()->rol == 'Admin'){

            $TotalVentas = Ventas::all()->sum('total');

        }elseif(auth()->user()->rol == 'Encargado'){

            $TotalVentas = Ventas::where('id_sucursal', auth()->user()->id_sucursal)->sum('total');
        }else {
            $TotalVentas = Ventas::where('id_vendedor', auth()->user()->id)->sum('total');
        }

        if(auth()->user()->rol == 'Admin'){

            $ventas = Ventas::orderBy('id', 'asc')->get();

        }else{

            $ventas = Ventas::orderBy('id', 'asc')->where('id_sucursal', auth()->user()->id_sucursal)->get();
        }

        // dd($ventas);

       // Primer grafico
       $arrayFechas = array();
       $sumaPagoMes = array();

        foreach($ventas as $venta){

            $fecha = substr($venta->fecha, 0, 7);

            // dd($fecha);

            $arrayFechas[] = $fecha;

            if(!isset($sumaPagoMes[$fecha])){

                $sumaPagoMes[$fecha] = 0;
            }

            $sumaPagoMes[$fecha] += $venta->total;
        }

        $noRepetirFechas = array_unique($arrayFechas);   
        
        // /SEGUNDO GRAFICO

        if(auth()->user()->rol == 'Admin'){

            $ventas2 = Ventas::pluck('id')->toArray();

        }else{

            $ventas2 = Ventas::orderBy('id', 'asc')
            ->where('id_sucursal', auth()->user()->id_sucursal)
            ->pluck('id')->toArray();
        }

        $totalVentas = count($ventas2);

        $totalProductosVendidos = db::table('venta_productos')
        ->whereIn('venta_productos.id_venta', $ventas2)
        ->count();

        $productosMasVendidos = DB::table('venta_productos')
        ->join('productos', 'venta_productos.id_producto', '=', 'productos.id')
        ->whereIn('venta_productos.id_venta', $ventas2)
        ->select(

            'venta_productos.id_producto',
            'productos.descripcion',
            'productos.imagen',
            DB::raw('COUNT(*) as venta'),
            DB::raw('ROUND((COUNT(*) / '.$totalProductosVendidos.') * 100, 2) as porcentaje')
        )
        ->groupBy('venta_productos.id_producto', 'productos.descripcion', 'productos.imagen')
        ->orderByDesc('ventas')
        ->take(10)->get();

        $colores = array( '#f56954', '#00a65a', '#f39c12', '#00c0ef');

        $productosRecientes = Productos::orderBy('agregado', 'desc')->limit(10)->get();

        $ventasVendedor = Ventas::where('id_vendedor', auth()->user()->id)->get();

        return view('modulos.inicio.Inicio', compact('categorias', 'clientes', 'productos', 'TotalVentas', 'colores', 'ventas', 'productosMasVendidos', 'noRepetirFechas', 'sumaPagoMes', 'totalProductosVendidos', 'productosRecientes', 'ventasVendedor'));
    }








}
