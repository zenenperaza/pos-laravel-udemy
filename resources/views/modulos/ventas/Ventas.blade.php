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

            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="modalCrearVenta">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

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

                                    <select name="id_cliente" id="" class="form-control input-lg" required>
                                        <option value="">Seleccionar Cliente</option>

                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->cliente }} - {{ $cliente->documento }}</option>
                                        @endforeach

                                    </select>                       

                            </div>                          
                        </div>






                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Susucrsla</button>


                </div>

            </form>

        </div>

    </div>

</div>


    
@endsection