@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Reportes de ventas</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-md-2">
                    <h4>Fecha inicial</h4>
                    <input type="date" id="fechaI" class="form-control">
                </div>

                <div class="col-md-2">
                    <h4>Fecha final</h4>
                    <input type="date" id="fechaF" class="form-control">
                </div>

                @if (auth()->user()->rol == 'Admin')

                    <div class="col-md-3">
                        <h4>Sucursal:</h4>
                        <select name="" id="id_sucursal" class="form-control">
                            <option value="0">Seleccionar...</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                
                @else

                    <input type="hidden" id="id_sucursal" value="{{ auth()->user()->id_sucursal }}">

                @endif

                <div class="col-md-3 btnFiltrar">
                    <h4>&nbsp;</h4>
                    <button class="btn btn-warning btnFiltrarReportes" url="{{ url('') }}">Filtrar</button>
                </div>

                <a href="{{ url('/'.$ruta_PDF) }}" target="_blank">
                    <button class="btn btn-default pull-right" style="margin-top: 5px">Generar reporte</button>
                </a>
            
            </div>

            <div class="box-body">

                <div class="row">
                    {{-- PRIMER GRAFICO --}}
                    <div class="col-xs-12">

                        <div class="box box-solid bg-teal-gradient">

                            <div class="box-header">
                                <i class="fa fa-th"></i>
                                <h3 class="box-title">Grafico de ventas</h3>
                            </div>

                            <div class="box-body border-radius-none nuevoGraficoVentas">

                                <div class="chart" id="line-chart-ventas" style="height:250px">

                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- SEGUNDO GRAFICO --}}
                    <div class="col-md-6 col-xs-12">

                        <div class="box box-default ">

                            <div class="box-header with-border">
                                <h3 class="box-title">Productos mas vendidos</h3>
                            </div>

                            <div class="box-body ">

                                <div class="row">

                                    <div class="col-md-7">
                                        <div class="chart-responsive" >
                                            <canvas id="pieChart" style="height: 150px"></canvas>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <ul class="chart-leyend clearfix">
                                            <?php
                                                foreach ($productosMasVendidos as $index => $producto ){
                                                    echo '  <li>
                                                    <i class="fa fa-circle-o" style="color:'.$colores[$index].'"></i>
                                                    '.$producto->descripcion.'
                                                </li>';
                                                }
                                                
                                            ?>
                                        </ul>
                                    </div>

                                </div>

                            </div>

                            <div class="box-footer no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                   
                                        <?php
                                            foreach ($productosMasVendidos as $index => $producto ){

                                                if ($producto->imagen == ' ') {
                                                    $imagen = "productos/default.png";
                                                } else {
                                                    $imagen = $producto->imagen;
                                                }



                                                echo '<li>
                                                <a> 
                                                    <img src="'.url("storage/".$imagen).'" class="img-thumbnail" width="60px" style="margin-right: 10px">
                                                    <span class="pull-right" style="color:'.$colores[$index].'">
                                                        '.$producto->porcentaje.'    
                                                    </span>
                                                </a>
                                            </li>';
                                            }
                                            
                                        ?>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- TERCER GRAFICO  --}}
                    <div class="col-md-6 col-xs-12">

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3>Vendedores</h3>
                            </div>
                            <div class="box-body">
                                <div class="chart-responsive">
                                    <div class="chart" id="bar-chart1" style="height: 300px">

                                    </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>
                    
                    {{-- CUARTO GRAFICO  --}}
                    <div class="col-md-6 col-xs-12">

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3>Compradores</h3>
                            </div>
                            <div class="box-body">
                                <div class="chart-responsive">
                                    <div class="chart" id="bar-chart2" style="height: 300px">

                                    </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>




                </div>

            </div>
        </div>

    </section>

</div>

    
@endsection