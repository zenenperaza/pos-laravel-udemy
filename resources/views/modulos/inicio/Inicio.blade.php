@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Inicio</h1>

    </section>

    <section class="content">

        <div class="row">

            @include('modulos.inicio.Cajas-Superiores')

        </div>

        @if (auth()->user()->rol != 'Vendedor')

            <div class="row">

                <div class="col-lg-12">

                    @include('modulos.inicio.Grafico-Ventas')

                </div>

                <div class="col-lg-6">

                    @include('modulos.inicio.Grafico-Productos-Mas-Vendidos')

                </div>

                <div class="col-lg-6">

                    @include('modulos.inicio.Productos-Recientes')

                </div>
            </div>

        @else

            @include('modulos.inicio.Mis-Ventas')
            
        @endif

    </section>

</div>

<div class="modal fade" id="modalAgregarSucursal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Sucursal</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                <input type="text" name="nombre" id="" class="form-control input-lg" placeholder="Ingresar Sucursal" required>    

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