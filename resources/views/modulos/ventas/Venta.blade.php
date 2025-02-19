@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrar Venta - {{ $venta->codigo }}</h1>

    </section>

    <section class="content">

        <div class="row">

            {{-- FORMULARIO DE VENTAS --}}
            <div class="col-lg-5 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border">

                        <div class="box-body">

                            <div class="box">

                                <div class="form-grupo">

                                    <div class="input-group">

                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>

                                        <input type="text" class="form-control input-lg" name="" id="" value="{{ $venta->VENDEDOR->name }}" readonly required>
                                    
                                    </div>
                                </div>

                                <div class="form-grupo">

                                    <div class="input-group">

                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>

                                        <input type="text" name="" id="" class="form-control input-lg" value="{{ $venta->codigo }}"  required>
                                    
                                    </div>
                                </div>

                                <div class="form-grupo">

                                    <div class="input-group">

                                        <span class="input-group-addon">
                                            <i class="fa fa-user-plus"></i>
                                        </span>

                                        <input type="text" name="" id="" class="form-control input-lg" value="{{ $venta->CLIENTE->cliente }}"  required>
                                    
                                    </div>
                                </div>

                                <div class="form-group row ProductosVenta">

                                    <input type="hidden" value="{{ $venta->id }}" id="idVenta" name="">
                                    <input type="hidden" value="{{ url('') }}" id="url" name="">
                                    <input type="hidden" value="{{ $venta->estado  }}" id="estado" name="">


                                </div>

                                <button class="btn btn-default hidden-lg" data-toggle="modal" data-target="#modalAgregarProductoVenta" >Agregar Producto</button>

                                <hr>

                                <div class="row">

                                    
                                    <div class="col-xs-8 pull-right">

                                        <table>

                                            <thead>

                                                <tr>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td style="width: 50%">

                                                        <div class="input-group">

                                                            <input type="number" class="form-control input-lg" min="0" name="" id="nuevoImpuestoVenta" value="{{ $venta->impuesto }}" placeholder="0" 
                                                            @if ($venta->estado == 'Finalizada')
                                                                readonly                                                                
                                                            @endif
                                                            >
                                                           <input type="hidden" id="nuevoPrecioNeto" > 
                                                        </div>

                                                    </td>

                                                    <td style="width: 50%">

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                            <input type="number" class="form-control input-lg" min="0" name="" id="nuevoPrecioTotal" value="" placeholder="0000" readonly required>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>                

                                </div>
                                <hr>

                                <div class="form-group row">

                                    @if ($venta->estado != 'Finalizada')

                                        <div class="col-xs-6" style="padding-right: 0px">
    
                                            <div class="input-group">
        
                                                <select name="" id="nuevoMetodoPago" class="form-control" required>
        
                                                    <option value=""> Seleccione metodo de pago</option>
                                                    <option value="Efectivo"> Efectivo</option>
                                                    <option value="TDC"> Tarjeta DC</option>
                                                    <option value="TDD"> Tarjeta DD</option>
                                                </select>
                                            </div>

                                        </div>
                                        
                                        <div class="cajasMetodoPago">
                                        </div>                                   

                                    @else

                                        <div class="col-xs-12" style="padding-right: 0px">
                                            <h4>Metodo de pago: <b>{{ $venta->metodo_pago }}</b> </h4>

                                        </div>

                                    @endif
    
                               





    
                                </div>

                                <br>

                            </div>

                            <div class="box-footer">

                                <button class="btn btn-success">Finalizar Venta</button>
            
                            </div>
                        </div>


                    </div>

            
                </div>

            </div>

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                
                <div class="box box-warning">

                    <div class="box-header with-border">
                        
                        <div class="box-body">

                            <table class="table table-bordered table-striped table-hover dt-responsive">

                                <thead>
            
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Imagen</th>
                                        <th>Codigo factura</th>
                                        <th>Descripcion</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
            
                                <tbody>
            
                                    @foreach ($productos as $key => $producto)
                                        <tr>
                                            <td style="width: 10px">{{ $key +  1 }}</td>
                                            <td>
                                                @if ($producto->imagen != '')
                                                    <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->producto }}" class="img-thumbnail" width="40px">
                                                    
                                                @else

                                                    <img src="{{ url('storage/productos/default.png') }}" alt="" class="img-thumbnail" width="40px">
                                                    
                                                @endif
                                            
                                            </td>
                                            <td>{{ $producto->codigo }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td>
                                                
                                                @if ($producto->stock <= 10)

                                                    <span class="badge bg-red">{{ $producto->stock }}</span>
                                                    
                                                @elseif ($producto->stock >= 11 && $producto->stock <= 20)

                                                    <span class="badge bg-yellow">{{ $producto->stock }}</span>
                                                
                                                @else 

                                                    <span class="badge bg-green">{{ $producto->stock }}</span>
                                                    
                                                @endif
                                            </td>                                                                     
                                            <td>  
                                                @if($venta->estado != 'Finalizada')

                                                        @if($producto->stock > 0)   
                                                        
                                                            @if ($producto->en_venta)
                                                                <button class="btn btn-default"  id="producto-{{ $producto->id }}"  >Agregar</button>           
                                                            @else                                                            
                                                                <button class="btn btn-primary AgregarProducto"  id="producto-{{ $producto->id }}" idProducto="{{ $producto->id }}" stock="{{ $producto->stock }}">Agregar</button>                                                        
                                                            @endif
                                                           
                                                        @else                                                        
                                                            <button class="btn btn-default"  id="producto-{{ $producto->id }}"  >Agregar</button>                                                        
                                                        @endif   

                                                    
                                                    
                                                @endif     
                                          
                                        
                                               
                                                
                                            </td> 
            
                                        </tr>
                                    @endforeach
            
                                </tbody>
                            </table>
            

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </section>

</div>

<div class="modal fade" id="modalAgregarProductoVenta">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar productos</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">          

                        <table class="table table-bordered table-striped table-hover dt-responsive">

                            <thead>
        
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Imagen</th>
                                    <th>Codigo factura</th>
                                    <th>Descripcion</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
        
                            <tbody>
        
                                @foreach ($productos as $key => $producto)
                                    <tr>
                                        <td style="width: 10px">{{ $key +  1 }}</td>
                                        <td>
                                            @if ($producto->imagen != '')
                                                <img src="{{ url('storage/'.$producto->imagen) }}" alt="{{ $producto->producto }}" class="img-thumbnail" width="40px">
                                                
                                            @else

                                                <img src="{{ url('storage/productos/default.png') }}" alt="" class="img-thumbnail" width="40px">
                                                
                                            @endif
                                        
                                        </td>
                                        <td>{{ $producto->codigo }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>
                                            
                                            @if ($producto->stock <= 10)

                                                <span class="badge bg-red">{{ $producto->stock }}</span>
                                                
                                            @elseif ($producto->stock >= 11 && $producto->stock <= 20)

                                                <span class="badge bg-yellow">{{ $producto->stock }}</span>
                                            
                                            @else 

                                                <span class="badge bg-green">{{ $producto->stock }}</span>
                                                
                                            @endif
                                        </td>                                                                     
                                        <td>  
                                            @if ($venta->estado != 'Finalizada')

                                                    @if ($producto->stock > 0)   
                                                    
                                                        @if ($producto->en_venta)
                                                            <button class="btn btn-default" id="productoModal-{{ $producto->id }}" >Agregar</button>           
                                                        @else                                                            
                                                            <button class="btn btn-primary AgregarProducto" id="productoModal-{{ $producto->id }}" idProducto="{{ $producto->id }}">Agregar</button>                                                        
                                                        @endif
                                                       
                                                    @else                                                        
                                                        <button class="btn btn-default"  id="productoModal-{{ $producto->id }}"  >Agregar</button>                                                        
                                                    @endif   

                                                
                                                
                                            @endif     
                                      
                                    
                                           
                                            
                                        </td> 
        
                                    </tr>
                                @endforeach
        
                            </tbody>
                        </table>
        
                          
                    </div>

                </div>             

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
                   
                </div>

            </form>

        </div>

    </div>

</div>
    

    
@endsection