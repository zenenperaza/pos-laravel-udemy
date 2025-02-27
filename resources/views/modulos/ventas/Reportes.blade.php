@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Reportes de ventas</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
            
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