<div class="box box-primary">   

    <div class="box-header with-border">
        <h3 class="box-title">Productos agregados recientes</h3>
    </div>

    <div class="box-body">

        <ul class="products-list products-list-box">

            @foreach ($productosRecientes as $producto)            

            <li class="item">

                <div class="product-img">

                    @if ($producto->imagen == ' ')
                        <img src="{{ url('storage/productos/default.png') }}" alt="">
                    @else
                    <img src="{{ url('storage/'.$producto->imagen) }}" alt="">
                    @endif

                    
                </div>

                <div class="product-info">
                    <a href="#" class="product-title"> {{ $producto->descripcion }}</a>
                    <span class="label label-warning pull-right">
                        $ {{ number_format( $producto->venta, 2 )}}
                    </span>
                </div>

            </li>

            @endforeach

        </ul>


    </div>

    <div class="box-footer text-center">
        <a href="Productos" class="uppercase">Ver productos</a>
    </div>

</div>