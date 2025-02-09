
$(".table").on('click', '.btnEditarCategoria', function () {
    
    var Cid = $(this).attr('idCategoria')

    console.log(Cid);
    

    $.ajax({

        url: 'Editar-Categoria/'+Cid,
        type: 'GET',
        success: function(respuesta){

            // console.log(respuesta["nombre"]);
            
            $('#nombreEditar').val(respuesta["nombre"])
            $('#idEditar').val(respuesta["id"])

        }
    })
})


$(".table").on('click', '.btnEliminarCategoria', function(){
    
    var Cid = $(this).attr('idCategoria')
    var categoria = $(this).attr('categoria')

    Swal.fire({

        title: '¿Eliminar Categoria: '+ categoria+'?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
    }).then((result)=> {

        if (result.isConfirmed) {
            
            window.location = "Eliminar-Categoria/"+Cid
        }
    })
})


$("#selectCategoria").change(function(){

    var idCategoria = $(this).val()

    $.ajax({

        url: 'Generar-Codigo-Producto/'+idCategoria,
        type: 'GET',
        success: function (respuesta) {
            
            if (respuesta == 0) {
                var nuevoCodigo = idCategoria+"01"
            } else {
                var nuevoCodigo = Number(respuesta["codigo"])+1
            }

            $("#codigoProducto").val(nuevoCodigo)
        }

    })
})

$("#selectCategoriaEditar").change(function(){

    var idCategoria = $(this).val()

    $.ajax({

        url: 'Generar-Codigo-Producto/'+idCategoria,
        type: 'GET',
        success: function (respuesta) {
            
            if (respuesta == 0) {
                var nuevoCodigo = idCategoria+"01"
            } else {
                var nuevoCodigo = Number(respuesta["codigo"])+1
            }

            $("#codigoProductoEditar").val(nuevoCodigo)
        }

    })
})



$('input[type="checkbox"].minimal').iCheck({

    checkboxClass: 'icheckbox_minimal-blue'

})

$("#precioCompra").change(function () {

    if ($(".minimal").prop('checked')) {
        
        var valorPorcentaje = $("#valorPorcentaje").val()

        var porcentaje = Number(($("#precioCompra").val() * valorPorcentaje / 100)) + Number($("#precioCompra").val())

        $("#precioVenta").val(porcentaje)
        $("#precioVenta").prop("readonly", true)
    }
    
})
    
$("#valorPorcentaje").change(function(){

    if ($(".minimal").prop('checked')) {
        
        var valorPorcentaje = $("#valorPorcentaje").val()

        var porcentaje = Number(($("#precioCompra").val() * valorPorcentaje / 100)) + Number($("#precioCompra").val())

        $("#precioVenta").val(porcentaje)
        $("#precioVenta").prop("readonly", true)
    }
})

$(".porcentaje").on('ifUnchecked', function () {
    $("#precioVenta").prop("readonly", false)
})

//EDITAR PRODUCTOS
$(".table").on('click', '.btnEditarProducto', function () {
    
    var Pid = $(this).attr('idProducto')

    $.ajax({

        url: 'Editar-Producto/'+Pid,
        type: 'GET',
        success: function (respuesta) {
            
            $("#idEditar").val(respuesta.id)
            $("#selectCategoriaEditar").val(respuesta.id_categoria)
            $("#codigoProductoEditar").val(respuesta.codigo)
            $("#descripcionEditar").val(respuesta.descripcion)
            $("#stockEditar").val(respuesta.stock)
            $("#precioCompraEditar").val(respuesta.precio_compra)
            $("#precioVentaEditar").val(respuesta.precio_venta)

            if (respuesta.imagen != ' ') {
                $("#imagenEditar").attr('src', 'storage/'+respuesta.imagen)
            } else{
                
                $("#imagenEditar").attr('src', 'storage/productos/default.png')
            }

        }
    })
})


$("#precioCompraEditar").change(function () {

    if ($(".porcentajeEditar").prop('checked')) {
        
        var valorPorcentajeEditar = $("#valorPorcentajeEditar").val()

        var porcentaje = Number(($("#precioCompraEditar").val() * valorPorcentajeEditar / 100)) + Number($("#precioCompraEditar").val())

        $("#precioVentaEditar").val(porcentaje)
        $("#precioVentaEditar").prop("readonly", true)
    }
    
})
    
$("#valorPorcentajeEditar").change(function(){

    if ($(".porcentajeEditar").prop('checked')) {
        
        var valorPorcentajeEditar = $("#valorPorcentajeEditar").val()

        var porcentaje = Number(($("#precioCompraEditar").val() * valorPorcentajeEditar / 100)) + Number($("#precioCompraEditar").val())

        $("#precioVentaEditar").val(porcentaje)
        $("#precioVentaEditar").prop("readonly", true)
    }
})

$(".porcentajeEditar").on('ifUnchecked', function () {
    $("#precioVentaEditar").prop("readonly", false)
})

//ELIMINAR PRODUCTOS
$(".table").on('click', '.btnEliminarProducto', function () {

    var Pid = $(this).attr('idProducto');
    var producto = $(this).attr('producto')


    Swal.fire({

        title: '¿Eliminar Producto: '+ producto +'?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
    }).then((result)=> {

        if (result.isConfirmed) {
            
            window.location = "Eliminar-Producto/"+Pid
        }
    })
})