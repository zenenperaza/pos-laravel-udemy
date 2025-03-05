<div class="box box-primary">   

    <div class="box-header with-border">
        <h3 class="box-title">Mis ventas</h3>
    </div>

    <div class="box-body">

        <table class="table table-bordered table-striped table-hover dt-responsive">

            <thead>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>Codigo factura</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Metodo pago</th>
                    <th>Neto</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Sucursal</th>
                    <th>Impuesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($ventasVendedor as $key => $venta)
                    <tr>
                        <th style="width: 10px">{{ $key +  1 }}</th>
                        <th>
                            {{ $venta->codigo }}
                        </th>
                        <th>{{ $venta->VENDEDOR->name }}</th>
                        <th>{{ $venta->CLIENTE->cliente }}</th>
                        <th>{{ $venta->metodo_pago }}</th>
                        <th>$ {{ number_format( $venta->neto , 2, ',', '.' ) }}</th>
                        <th>
                            $ {{ number_format( $venta->total, 2, ',', '.' ) }}
                        </th>
                        <th>{{ $venta->fecha }}</th>
                        <th>{{ $venta->estado }}</th>
                        <th>{{ $venta->id_sucursal }}</th>
                        <th>$ {{ $venta->impuesto }}</th>
                        <th>
                            @if ($venta->estado != 'Finalizada')
                                <button class="btn btn-danger btnEliminarVenta" idVenta="{{ $venta->id }}" venta="{{ $venta->venta }}" ><i class="fa fa-trash"></i></button>
                            @else
                            <a href="{{ url('Factura/'.$venta->id) }}" target="_blank" rel="noopener noreferrer">
                                <button class="btn btn-info" ><i class="fa fa-print"></i></button>
                            </a>
                            @endif
                            
                            <a href="{{ url('Venta/'.$venta->id) }}">
                                <button class="btn btn-primary btnEditarVenta" >Administrar</button>
                            </a>
                        </th> 

                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>


</div>