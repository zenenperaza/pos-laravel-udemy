@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Inicio</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarSucursal">Agregar Sucursal</button>
            </div>

            <div class="body">

            </div>
        </div>

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
    

<div class="modal fade" id="modalAgregarSucursal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Sucursal</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select name="id_categoria" id="selectCategoria" class="form-control input-lg">

                                    <option value="">Seleccionar Categoría</option>

                            
                                </select>


                            </div>

                        </div>

                            {{-- CODIGO --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="codigoSucursal" name="codigo" readonly>


                            </div>

                        </div>

                            {{-- DESCRIPCION --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg input__text" id="" name="descripcion" required placeholder="Descripcion">


                            </div>
                        </div>

                        {{-- STOCK --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                <input type="number" min="0" class="form-control input-lg input__text" id="" name="stock" placeholder="Stock" required>


                            </div>
                        </div>

                        {{-- PRECIOS --}}

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <div class="input-group">
            
                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
            
                                    <input type="number" min="0" class="form-control input-lg input__text" id="precioCompra" name="precio_compra" placeholder="Precio compra" >
            
                                    
                                </div>
                            </div>

                            <div class="col-xs-6">
            
                                    <div class="input-group">
                
                                        <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                
                                        <input type="number" min="0" class="form-control input-lg input__text" id="precioVenta" name="precio_venta" placeholder="Precio venta" >
                
                
                                    </div>
                        

                                <br>

                            

                                <div class="col-xs-6">
                
                                    <div class="input-group">
                
                                    <label for="">
                                            <input type="checkbox" class="minimal porcentaje" checked>
                                            Utilizar porcentaje
                                    </label>
                
                                    </div>
                                </div>                   

                                <div class="col-xs-6" style="padding:0">
                
                                    <div class="input-group">
                
                                        <input type="number" min="0" class="form-control input-lg input__text " id="valorPorcentaje" name="impuesto" value="40" required>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                    
                
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- IMAGEN --}}

                        <div class="form-group">

                            <div class="input-group">

                                <div class="panel">SUBIR IMAGEN</div>

                                <input type="file" class="form-control input-lg input__text" id="" name="imagen" >

                                <img src="{{ url('storage/productos/default.png') }}" alt="" class="img-thumbnail " width="100px">

                            </div>

                        </div>                     

                          
                    </div>

                </div>

             

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Sucursal</button>


                </div>

            </form>

        </div>

    </div>

</div>

    
@endsection