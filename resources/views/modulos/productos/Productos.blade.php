@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Productos</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto" >Agregar Producto</button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive">

                    <thead>

                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Imagen</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Precio Compra</th>
                            <th>Preico Venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($productos as $key => $producto)
                            <tr>
                                <th style="width: 10px">{{ $key +  1 }}</th>
                                <th>
                                    @if ($producto->imagen == " ")
                                        <img src="{{ url('storage/productos/default.png') }}" alt="" class="img-thumbnail " width="40px">
                                    @else
                                    
                                    <img src="{{ url('storage/'.$producto->imagen) }}" alt="" class="img-thumbnail " width="40px">
                                
                                    @endif
                                </th>
                                <th>{{ $producto->codigo }}</th>
                                <th>{{ $producto->descripcion }}</th>
                                <th>{{ $producto->categoria_nombre }}</th>
                                <th>
                                    @if ( $producto->stock <= 10)
                                        <button class="btn btn-warning">{{ $producto->stock }}</button>
                                    @elseif ($producto->stock > 10 && $producto->stock <= 15 )                                        
                                        <button class="btn btn-danger">{{ $producto->stock }}</button>
                                    @else
                                        <button class="btn btn-success">{{ $producto->stock }}</button>
                                    @endif
                                </th>
                                <th>$ {{ number_format($producto->precio_compra, 2, ',', '.')   }}</th>
                                <th>$ {{ number_format($producto->precio_venta , 2, ',', '.') }}</th>
                                <th>{{ $producto->agregado }}</th>
                                <th>
                                    <button class="btn btn-warning btnEditarProducto" idProducto="{{ $producto->id }}" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btnEliminarProducto" idProducto="{{ $producto->id }}" producto="{{ $producto->descripcion }}" ><i class="fa fa-trash"></i></button>
                                </th> 

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="modalAgregarProducto">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Producto</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select name="id_categoria" id="selectCategoria" class="form-control input-lg">

                                    <option value="">Seleccionar Categoría</option>

                                    @foreach ($categorias as $categoria)

                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        
                                    @endforeach
                                </select>


                            </div>

                        </div>

                            {{-- CODIGO --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="codigoProducto" name="codigo" readonly>


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
                    
                    <button class="btn btn-primary" type="submit" >Agregar Producto</button>


                </div>

            </form>

        </div>

    </div>

</div>



<div class="modal fade" id="modalEditarProducto">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ url('Actualizar-Producto') }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('put')

                <div class="modal-header" style="background: #ffc107; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Producto</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select name="id_categoria" id="selectCategoriaEditar" class="form-control input-lg">

                                    <option value="">Seleccionar Categoría</option>

                                    @foreach ($categorias as $categoria)

                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        
                                    @endforeach
                                </select>


                            </div>

                        </div>

                            {{-- CODIGO --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="codigoProductoEditar" name="codigo" readonly>
                                <input type="hidden" class="form-control input-lg" id="idEditar" name="id" readonly>


                            </div>

                        </div>

                            {{-- DESCRIPCION --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg input__text" id="descripcionEditar" name="descripcion" required placeholder="Descripcion">


                            </div>
                        </div>

                        {{-- STOCK --}}

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                <input type="number" min="0" class="form-control input-lg input__text" id="stockEditar" name="stock" placeholder="Stock" required>


                            </div>
                        </div>

                        {{-- PRECIOS --}}

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <div class="input-group">
            
                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
            
                                    <input type="number" min="0" class="form-control input-lg input__text" id="precioCompraEditar" name="precio_compra" placeholder="Precio compra" >
            
                                    
                                </div>
                            </div>

                            <div class="col-xs-6">
            
                                    <div class="input-group">
                
                                        <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                
                                        <input type="number" min="0" class="form-control input-lg input__text" id="precioVentaEditar" name="precio_venta" placeholder="Precio venta" >
                
                
                                    </div>
                        

                                <br>

                            

                                <div class="col-xs-6">
                
                                    <div class="input-group">
                
                                    <label for="">
                                            <input type="checkbox" class="minimal porcentajeEditar" checked>
                                            Utilizar porcentaje
                                    </label>
                
                                    </div>
                                </div>                   

                                <div class="col-xs-6" style="padding:0">
                
                                    <div class="input-group">
                
                                        <input type="number" min="0" class="form-control input-lg input__text " id="valorPorcentajeEditar" name="impuesto" value="40" required>
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

                                <img src="{{ url('storage/productos/default.png') }}" id="imagenEditar" alt="" class="img-thumbnail " width="100px">

                            </div>

                        </div>                     

                          
                    </div>

                </div>

             

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-success" type="submit" >Actualizar Producto</button>


                </div>

            </form>

        </div>

    </div>

</div>



    
    
@endsection