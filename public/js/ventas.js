$(".table").on("click", ".AgregarProducto", function () {

    var idProducto = $(this).attr("idProducto")
    var idVenta = $("#idVenta").val()
    var url = $("#url").val()

    $(this).removeClass("btn-primary AgregarProducto")
    $(this).addClass("btn-default")

    $.ajax({
        url: url + '/Agregar-Producto-Venta',
        type: 'POST',
        data: {
            idProducto: idProducto,
            idVenta: idVenta
        },
        success: function (respuesta) {
           
            $(".ProductosVenta").append(

                '<div class="row producto-item" id="prod-'+respuesta.id+'" style="padding: 5px 15px">'+
                                        '<div class="col-xs-6" style="padding-right: 0px">'+
                                            '<div class="input-group">'+

                                                '<span class="input-group-addon">'+
                                                    '<button class="btn btn-danger btn-xs QuitarProductoVenta" idProducto="'+respuesta.id+'" >'+
                                                        '<i class="fa fa-times">'+
                                                        '</i>'+
                                                    '</button>'+
                                                '</span>'+
                                                '<input type="text" class="form-control" value="'+respuesta.descripcion+'" readonly>  '+
                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-xs-3" style="padding-right: 0px">'+

                                            '<div class="input-group">'+

                                                '<input type="number" idProducto="'+respuesta.id+'" class="form-control nuevaCantidadProducto" value="'+respuesta.cantidad+'"  stock="'+respuesta.stock+'"  min="1" required>'+

                                            '</div>'+

                                        '</div>'+

                                        '<div class="col-xs-3" style="padding-right: 0px">'+

                                            '<div class="input-group">'+

                                                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                                               '<input type="text" class="form-control nuevoPrecioProducto" id="precio-p-'+respuesta.id+'" precioReal="'+respuesta.precio_venta+'" value="'+respuesta.precio_venta+'" readonly>'+

                                            '</div>'+

                                        '</div>'+

                                        '<div class="col-xs-12" id="cantidad-p-'+respuesta.id+'" style="display:none">'+

                                            '<p class="alert alert-danger"> la cantidad supera el stock </p>'+                                        
                                        
                                        '</div>'+

                                    '</div>'

            )
           
            PrecioVenta()
            
        }
    });
    

});


function CargarProductosVenta() {

    var idVenta = $("#idVenta").val()
    var url = $("#url").val()
    var estado = $("#estado").val()

    $.ajax({
        url: url + '/Cargar-Productos-Venta/' + idVenta,
        type: 'GET',
        data: {
            idVenta: idVenta
        },
        success: function (respuesta) {

            var productos = respuesta.productos

            productos.forEach( function(respuesta) {
            
                if (estado == 'Finalizada') {
                    
                    var readonly = 'readonly'
                    var botonCancelar = ''

                } else {
                    
                    var readonly = ''
                    var botonCancelar = '<span class="input-group-addon">'+
                                                    '<button class="btn btn-danger btn-xs QuitarProductoVenta" type="button"  idProducto="'+respuesta.id+'" >'+
                                                        '<i class="fa fa-times">'+
                                                        '</i>'+
                                                    '</button>'+
                                                '</span>'
                }
                           
            $(".ProductosVenta").append(

                '<div class="row producto-item" id="prod-'+respuesta.id+'" style="padding: 5px 15px">'+

                                        '<div class="col-xs-6" style="padding-right: 0px">'+

                                            '<div class="input-group">'+

                                                botonCancelar+

                                                '<input type="text" class="form-control" value="'+respuesta.descripcion+'" readonly>  '+


                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-xs-3" style="padding-right: 0px">'+

                                        '<div class="input-group">'+

                                            '<input type="number" class="form-control nuevaCantidadProducto" value="'+respuesta.cantidad+'"  idProducto="'+respuesta.id+'"  stock="'+respuesta.stock+'"    min="1" required>'+

                                        '</div>'+

                                    '</div>'+

                                        '<div class="col-xs-3" style="padding-right: 0px">'+

                                            '<div class="input-group">'+
                                                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                                            '<input type="text" class="form-control nuevoPrecioProducto" id="precio-p-'+respuesta.id+'" precioReal="'+respuesta.precio_venta+'" value="'+respuesta.precio_venta+'" readonly>'+

                                            '</div>'+

                                        '</div>'+                                        

                                        '<div class="col-xs-12" id="cantidad-p-'+respuesta.id+'" style="display:none">'+

                                            '<p class="alert alert-danger"> la cantidad supera el stock </p>'+                                        
                                        
                                        '</div>'+


                                    '</div>'

            )

            PrecioVenta()
            
            });

        }
    });
}

CargarProductosVenta()


$(".ProductosVenta").on("click", ".QuitarProductoVenta", function () {

    var idVenta = $("#idVenta").val()
    var url = $("#url").val()
    var idProducto = $(this).attr("idProducto") 

    $.ajax({
        url: url + '/Quitar-Producto-Venta',
        type: 'POST',
        data: {
            idProducto: idProducto,
            idVenta: idVenta
        },
        success: function () {

            $("#producto-"+idProducto).addClass("btn-primary AgregarProducto").removeClass("btn-default");
        
            $("#productoModal-"+idProducto).addClass("btn-primary AgregarProducto").removeClass("btn-default");

            $("#prod-"+idProducto).hide().removeAttr('id')

            $("#precio-p-"+idProducto).removeClass("nuevoPrecioProducto")

            PrecioVenta()             }
    });

    PrecioVenta()


});


$(".ProductosVenta").on("change", ".nuevaCantidadProducto", function () {

    var idProducto = $(this).attr('idProducto')
    var stock = $(this).attr('stock')
    var cantidad = $(this).val()
    var precio = $("#precio-p-"+idProducto).attr('precioReal')

    var precioFinal = cantidad * precio

    $("#precio-p-"+idProducto).val(precioFinal)
    
    $("#cantidad-p-"+idProducto).hide()

    PrecioVenta()

    if (Number(cantidad) > Number(stock)) {
        $(this).val(stock)        
        $("#precio-p-"+idProducto).val(stock * precio)
        $("#cantidad-p-"+idProducto).show()

        PrecioVenta()

    }


});


$(".ProductosVenta").on("keyup", ".nuevaCantidadProducto", function () {

    var idProducto = $(this).attr('idProducto')
    var stock = $(this).attr('stock')
    var cantidad = $(this).val()
    var precio = $("#precio-p-"+idProducto).attr('precioReal')

    var precioFinal = cantidad * precio

    $("#precio-p-"+idProducto).val(precioFinal)
    
    $("#cantidad-p-"+idProducto).hide()

    PrecioVenta()

    if (Number(cantidad) > Number(stock)) {
        $(this).val(stock)        
        $("#precio-p-"+idProducto).val(stock * precio)
        $("#cantidad-p-"+idProducto).show()

        PrecioVenta()
    }

});

$("#nuevoImpuestoVenta").on("change", PrecioVenta)

function PrecioVenta() {
    
    const precioProductos = document.querySelectorAll('.nuevoPrecioProducto')

    let sumaTotal = 0

    precioProductos.forEach(precio => {

        const valor = parseFloat(precio.value) || 0

        sumaTotal += valor

    })

    $("#nuevoPrecioNeto").val(sumaTotal)

    var impuesto = $("#nuevoImpuestoVenta").val()

    if(impuesto == 0) {

        $("#nuevoPrecioTotal").val(sumaTotal)

    }else{

        var precioImpuesto = Number(sumaTotal * impuesto / 100)

        var totalConImpuesto = Number(precioImpuesto) + Number(sumaTotal)
        
        $("#nuevoPrecioTotal").val(totalConImpuesto)
    }

}   