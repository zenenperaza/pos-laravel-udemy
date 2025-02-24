@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Ventas</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary"  data-toggle="modal" data-target="#modalCrearVenta">Crear Venta</button>
            </div>

            <div class="body">

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

                        @foreach ($ventas as $key => $venta)
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

    </section>

</div>

<div class="modal fade" id="modalCrearVenta">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Nueva Venta</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="hidden" name="id_vendedor" id="" value="{{ auth()->user()->id }}" class="form-control input-lg" readonly required>    
                                <input type="text" value="{{ auth()->user()->name }}" class="form-control input-lg" readonly required>    


                            </div>                          
                        </div>

                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                @if(auth()->user()->rol == 'Admin')

                                    <select name="id_sucursal" id="" class="form-control input-lg" required>
                                        <option value="">Seleccione una Sucursal</option>

                                        @foreach($sucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                        @endforeach

                                    </select>

                                @else 

                                    <input type="hidden" name="id_sucursal" id="" value="{{ auth()->user()->id_sucursal }}" class="form-control input-lg" readonly required>    
                                    <input type="text" value="{{ auth()->user()->sucursal->nombre }}" class="form-control input-lg" readonly required>

                                @endif

                            </div>                          
                        </div>

                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                    <select name="id_venta" id="" class="form-control input-lg" required>
                                        <option value="">Seleccionar Venta</option>

                                        @foreach($ventas as $venta)
                                            <option value="{{ $venta->id }}">{{ $venta->venta }} - {{ $venta->documento }}</option>
                                        @endforeach

                                    </select>                       

                            </div>                          
                        </div>






                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Crear Venta</button>


                </div>

            </form>

        </div>

    </div>

</div>


    
@endsection
