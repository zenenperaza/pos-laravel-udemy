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

                                                '<input type="number" idProducto="'+respuesta.id+'" class="form-control nuevaCantidadProducto" value="'+respuesta.cantidad+'"  stock="'+respuesta.stock+'"  min="1" >'+

                                            '</div>'+

                                        '</div>'+

                                        '<div class="col-xs-3" style="padding-right: 0px">'+

                                            '<div class="input-group">'+

                                                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                                               '<input type="text" class="form-control nuevoPrecioProducto" id="precio-p-'+respuesta.id+'" precioReal="'+respuesta.precio_venta+'" value="'+respuesta.precio_venta * respuesta.cantidad+'" readonly>'+

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
                                            '<input type="text" class="form-control nuevoPrecioProducto" id="precio-p-'+respuesta.id+'" precioReal="'+respuesta.precio_venta+'" value="'+respuesta.precio_venta * respuesta.cantidad+'" readonly>'+

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

            PrecioVenta()             
        }
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


$("#nuevoMetodoPago").on("change", function () {    

    var metodo = $(this).val()   
    
    if (metodo != 0) {

        $("#btnFinalizarVenta").show()
        
        if(metodo == 'Efectivo') {

            $(this).parent().parent().removeClass('col-xs-6').addClass('col-xs-4')
            $(this).parent().parent().parent().children(".cajasMetodoPago").html(
                '<div class="col-xs-4">'+
                                                
                        '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control input-lg" id="nuevoValorEfectivo" value="" placeholder="0000">'+

                        '</div>'+

                    '</div> '+

                    '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

                        '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control input-lg" id="nuevoCambioEfectivo" value="" placeholder="0000">'+

                        '</div>'+

                    '</div>'
            
            )

        } else {

            $(this).parent().parent().removeClass('col-xs-6').addClass('col-xs-4')
            $(this).parent().parent().parent().children(".cajasMetodoPago").html(

                '<div class="col-xs-6" style="padding-left:0px">'+
                                                
                        '<div class="input-group">'+

                            '<input type="number" class="form-control input-lg" id="nuevoCodigoTransaccion" value="" placeholder="Codigo de transaccion">'+

                            '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+

                        '</div>'+

                    '</div> '

            
            )

        }
        
    } else {

        $("#btnFinalizarVenta").hide()
        $(this).parent().parent().removeClass('col-xs-4').addClass('col-xs-6')  
        $(this).parent().parent().parent().children(".cajasMetodoPago").html('')

    }

})


$(document).on("keyup", "#nuevoValorEfectivo", function () {

    var efectivo = $(this).val()
    var totalVenta = $("#nuevoPrecioTotal").val()

    var cambio = efectivo - totalVenta

    if(cambio >= 0){
        $("#nuevoCambioEfectivo").val(cambio)
    }else{
        $("#nuevoCambioEfectivo").val(0)
    }

})


$(document).on("change", "#nuevoValorEfectivo", function () {

    var efectivo = $(this).val()
    var totalVenta = $("#nuevoPrecioTotal").val()

    var cambio = efectivo - totalVenta

    if(cambio >= 0){
        $("#nuevoCambioEfectivo").val(cambio)
    }else{
        $("#nuevoCambioEfectivo").val(0)
    }
    
})


$("#btnFinalizarVenta").on('click', function() {

    var idVenta = $("#idVenta").val()
    var url = $("#url").val()

    var productos = []

    $(".producto-item").each(function(){
        
        var idProducto = $(this).find('.nuevaCantidadProducto').attr('idProducto')
        var cantidad = parseInt($(this).find('.nuevaCantidadProducto').val())
        var precio = parseFloat($(this).find('.nuevoPrecioProducto').val())

        productos.push({
            id: idProducto,
            cantidad: cantidad,
            precio: precio
        })

    })

    var impuesto = $("#nuevoImpuestoVenta").val()
    var total = $("#nuevoPrecioTotal").val()
    var neto = $("#nuevoPrecioNeto").val()
    var metodo = $("#nuevoMetodoPago").val()

    if(metodo != 'Efectivo'){

        var metodo_pago = metodo +'-'+ $("#nuevoCodigoTransaccion").val()

    }else{

        var metodo_pago = metodo
    }

    var pago = []
    pago.push({
        impuesto: impuesto,
        neto: neto,
        total: total,
        metodo_pago: metodo_pago
    })

    $.ajax({
        url: url + '/Finalizar-Venta',
        type: 'POST',
        data: {
            idVenta: idVenta,
            productos: productos,
            pago: pago
        },
        success: function () {
           location.reload()
        }
    });


})

$(".table").on("click", ".btnEliminarVenta", function () {

    var idVenta = $(this).attr("idVenta")

    Swal.fire({

        title: '¿Eliminar Venta  ?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
    }).then((result)=> {

        if (result.isConfirmed) {
            
            window.location = "Eliminar-Venta/"+idVenta
        }
    })

})

$(".btnFiltrar").on('click', '.btnFiltrarReportes', function () {
    
    if($("#fechaI").val() == ''){
        var fechaI = '0001/01/01'
    } else{
        var fechaI = $("#fechaI").val()
    }

    if($("#fechaF").val() == ''){
        var fechaF = '9999/12/31'
    } else{
        var fechaF = $("#fechaF").val()
    }

    var url = $(this).attr('url')
    var sucursalID = $('#id_sucursal').val()

    var FechaInicial = fechaI.replace(/\//g, "-")
    var FechaFinal = fechaF.replace(/\//g, "-")

    window.location = url+'/ReportesFiltrados/'+FechaInicial+'/'+FechaFinal+'/'+sucursalID

} )

