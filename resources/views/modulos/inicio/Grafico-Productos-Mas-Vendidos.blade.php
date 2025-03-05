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