@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Inicio</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClientes">Agregar Clientes</button>
            </div>

            <div class="body">
                <table class="table table-bordered table-striped table-hover dt-responsive">

                    <thead>

                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Fecha Nac</th>
                            <th>Total compras</th>
                            <th>Última Compra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($clientes as $key => $cliente)
                            <tr>
                                <th style="width: 10px">{{ $key +  1 }}</th>
                                <th>
                                    {{ $cliente->cliente }}
                                </th>
                                <th>{{ $cliente->documento }}</th>
                                <th>{{ $cliente->email }}</th>
                                <th>{{ $cliente->telefono }}</th>
                                <th>
                                    {{ $cliente->direccion }}
                                </th>
                                <th>{{ $cliente->fecha_nac }}</th>
                                <th>{{ $cliente->cantidad_compras }}</th>
                                <th>{{ $cliente->ultima_compra }}</th>
                                <th>
                                    <button class="btn btn-warning btnEditarCliente" idCliente="{{ $cliente->id }}"  cliente="{{ $cliente->cliente }}" data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btnEliminarCliente" idCliente="{{ $cliente->id }}" cliente="{{ $cliente->cliente }}" ><i class="fa fa-trash"></i></button>
                                </th> 

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="modalAgregarClientes">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Clientes</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <input type="text" name="cliente" id="" class="form-control input-lg" placeholder="Cliente" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" name="documento" id="nuevoDocumento" class="form-control input-lg" placeholder="Documento" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" name="email" id="" class="form-control input-lg" placeholder="Email" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input type="tel" name="telefono" id="" class="form-control input-lg" placeholder="Telefono" data-mask data-inputmask='"mask": "(99) 999-999-9999"' required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>

                                <input type="text" name="direccion" id="" class="form-control input-lg" placeholder="Direccion" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" name="fecha_nac" id="" class="form-control input-lg" placeholder="Fecha Nacimiento"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>    

                            </div>
                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Cliente</button>


                </div>

            </form>

        </div>

    </div>

</div>
   


<div class="modal fade" id="modalEditarCliente">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" action="{{ url('Actualizar-Cliente') }}">

                @csrf
                @method('PUT')

                <div class="modal-header" style="background: #ffc107; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Clientes</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <input type="text" name="cliente" id="nombreEditar" class="form-control input-lg"  required>    
                                <input type="hidden" name="id" id="idCliente" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" name="documento" id="documentoEditar" class="form-control input-lg"  required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" name="email" id="emailEditar" class="form-control input-lg"  required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input type="tel" name="telefono" id="telefonoEditar" class="form-control input-lg"  data-mask data-inputmask='"mask": "(99) 999-999-9999"' required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>

                                <input type="text" name="direccion" id="direccionEditar" class="form-control input-lg"  required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" name="fecha_nac" id="fecha_nacEditar" class="form-control input-lg"   data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>    

                            </div>
                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Cliente</button>


                </div>

            </form>

        </div>

    </div>

</div>
   

    
@endsection