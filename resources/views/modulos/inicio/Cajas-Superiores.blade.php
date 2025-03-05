
    <div class="col-md-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    $ {{ number_format( $TotalVentas , 2 )}}
                </h3>
                <p>Ventas</p>
            </div>
            <div class="icon">
                <i class="ion ion-social-usd"></i>
            </div>
            <a href="Ventas" class="small-box-footer">
                Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
       
    </div>
    
    <div class="col-md-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    {{ $categorias }}
                </h3>
                <p>Categorias</p>
            </div>
            <div class="icon">
                <i class="fa fa-th"></i>
            </div>
            <a href="Categorias" class="small-box-footer">
                Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
       
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    {{ $clientes }}
                </h3>
                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="Clientes" class="small-box-footer">
                Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
       
    </div>
    <div class="col-md-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    {{ $productos }}
                </h3>
                <p>Productos</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="Productos" class="small-box-footer">
                Mas info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
       
    </div>

