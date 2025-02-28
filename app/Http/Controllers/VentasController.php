<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Sucursales;
use App\Models\User;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;

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

    public function Factura($id_venta)
    {
        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('System POS');

        $pdf->AddPage();

        $logoPath = public_path('storage/plantilla/logo-negro-bloque.png');

        $venta = Ventas::find($id_venta);

        $html = '<table>
    <tr>
        <td style="width: 150px; background-color:blue; text-align:center"><img src="'.$logoPath.'" width="120px" alt=""> </td>
        <td style="background-color:red" width="140px">      
            <div style="font-size: 8.5px; text-align:left; line-height:15px">
                NIT: J-398785693
                <br>
                DIRECCION: Av. 4 con calle 5
            </div>
        </td>
        <td style="background-color:black" width="140px">    
            <div style="font-size: 8.5px; text-align:left; line-height:15px; ">                
                TELEFONO: 0414-1234567
                <br>
                EMAIL: zenenperaza@gmail.com

            </div>
        </td>
        <td style="background-color:white" width="110px">
            <div style="font-size: 8.5px; text-align:center; line-height:15px; color:red">          
                FACTURA: '.$venta->codigo.'
                <br>
                FECHA: '.$venta->fecha.'
            </div>
        </td>
    </tr>
<table>
    <table>
        <tr>
        <td style="width: 540px"></td>
        </tr>
    <table>

    <table>
        <tr>
           <td style="width: 340px; background-color: white; border: 1px solid #666">
            CLIENTE: '.$venta->CLIENTE->cliente.'
           </td>

            <td style="width: 200px; background-color: white; border: 1px solid #666">
            FECHA: '.$venta->fecha.'
           </td>
        </tr>
        <tr>
           <td style="width: 540px; background-color: white; border: 1px solid #666">
            VENDEDOR: '.$venta->VENDEDOR->name.'
           </td>
           
           <td style="width: 540px; background-color: white; border: 1px solid #666">
            
           </td>

           
        </tr>
    <table>';

    $html .= '<table border-top="1" style="width: 540px; background-color: white; border-top: 1px solid #666">
    
        <tr>
        <td></td>
        
        </tr>
    </table>';

    $html .= '<table border="1" style="font-size:10px; padding: 5px 10px; width: 540px; background-color: white">
        <tr style="background-color: #c0c0c0">
            <td style="border: 1px solid #666; width: 240px; text-align:center">PRODUCTO</td>        
      
            <td style="border: 1px solid #666; width: 80px; text-align:center">CANTIDAD</td>        
     
            <td style="border: 1px solid #666; width: 100px; text-align:center">PRECIO UNTI</td>        
      
            <td style="border: 1px solid #666; width: 100px; text-align:center">PRECIO TOTAL</td>        
        </tr>
        
    </table>';

     $productosVenta = DB::table('venta_productos')
     ->join('productos', 'venta_productos.id_producto', '=', 'productos.id')
     ->where('venta_productos.id_venta', $id_venta)
     ->get();

     $html .= '<table border="1" style="font-size:10px; padding: 5px 10px; width: 540px; background-color: white">
            ';

     foreach($productosVenta as $producto){
    
        $html .= '<tr style="background-color: white"><td style="border: 1px solid #666; width: 240px; text-align:center">'.$producto->descripcion.'</td>        
        
                <td style="border: 1px solid #666; width: 80px; text-align:center">'.$producto->cantidad.'</td>        
        
                <td style="border: 1px solid #666; width: 100px; text-align:center">'.$producto->precio_venta.'</td>        
        
                <td style="border: 1px solid #666; width: 100px; text-align:center">'.$producto->precio_venta * $producto->cantidad.'</td></tr>';

    }

    $html .= '            
        </table>';

        
    $html .= '<table style="font-size:10px; padding: 5px 10px">
                <tr>
                    <td style="color:#333; background-color:white; width: 320px"></td>

                    <td style="border-bottom: 1px solid #666; width: 100px; text-align:center"></td>
                    <td style="border-bottom: 1px solid #666; width: 100px; text-align:center"></td>
                </tr> 

                <tr>
                    <td style="border-right: 1px solid #666; color:#333; background-color:white; width: 320px"></td>

                    <td style="border-bottom: 1px solid #666; width: 100px; text-align:center">Neto: </td>
                    <td style="border: 1px solid #666; width: 100px; text-align:center">$ '.number_format( $venta->neto , 2, ',', '.' ) .'</td>
                </tr>                 

                <tr>
                    <td style="border-right: 1px solid #666; color:#333; background-color:white; width: 320px"></td>

                    <td style="border-bottom: 1px solid #666; width: 100px; text-align:center">Impuesto: </td>
                    <td style="border: 1px solid #666; width: 100px; text-align:center">% '.$venta->impuesto.'</td>
                </tr>              

                <tr>
                    <td style="border-right: 1px solid #666; color:#333; background-color:white; width: 320px"></td>

                    <td style="border-bottom: 1px solid #666; width: 100px; text-align:center">Total: </td>
                    <td style="border: 1px solid #666; width: 100px; text-align:center">% '.number_format( $venta->total , 2, ',', '.' ).'</td>
                </tr>               
            </table>';


        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Factura-'.$venta->codigo.'.pdf', 'I');
        


    }

    public function Reportes(){

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

        //TERCER GRAFICO
            $usuarios = User::all();
            $sumaTotalVendedores = [];

            foreach($ventas as $valueVentas){

                foreach($usuarios as $valueUsuarios){

                    if ($valueUsuarios["id"] == $valueVentas["id_vendedor"]) {

                        $nombreVendedor = $valueUsuarios["name"];

                        if (!isset($sumaTotalVendedores[$nombreVendedor])) {
                            
                            $sumaTotalVendedores[$nombreVendedor] = 0;
                        }

                        $sumaTotalVendedores[$nombreVendedor] += $valueVentas["neto"];

                    }
                }
            }

            $noRepetirNombres = array_keys($sumaTotalVendedores);



            //CUARTO GRAFICO
            $clientes = Clientes::all();
            $sumaTotalClientes = [];

            foreach($ventas as $valueVentas){

                foreach($clientes as $valueClientes){

                    if ($valueUsuarios["id"] == $valueVentas["id_vendedor"]) {

                        $nombreVendedor = $valueUsuarios["name"];

                        if (!isset($sumaTotalVendedores[$nombreVendedor])) {
                            
                            $sumaTotalVendedores[$nombreVendedor] = 0;
                        }

                        $sumaTotalVendedores[$nombreVendedor] += $valueVentas["neto"];

                    }
                }
            }

            $noRepetirNombres = array_keys($sumaTotalVendedores);
        

        return view('modulos.ventas.Reportes', compact('noRepetirFechas', 'sumaPagoMes', 'productosMasVendidos', 'colores', 'noRepetirNombres', 'sumaTotalVendedores'));
    }


}
