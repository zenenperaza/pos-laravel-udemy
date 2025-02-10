

$('[data-mask]').inputmask();

$(function () {
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
})


$("#nuevoDocumento").change(function () {    

    $(".alert").remove()
    
    var document = $(this).val()

    $.ajax({

        url: 'Validar-Documento',
        type: 'POST',
        data: {documento: document, id: 0},
        success: function (respuesta) {
            if (!respuesta) {
                $("#nuevoDocumento").parent().after('<div class="alert alert-danger">Documento existe</div>')
            } else {
                console.log("holis");
                
            }
           
        }
    })
})


$(".table").on('click', '.btnEditarCliente', function () {
    
    var idC = $(this).attr('idCliente')
    var nombre = $(this).attr('cliente')    

    $.ajax({

        url: 'Editar-Cliente/'+idC,
        type: 'GET',
        success: function(respuesta){

            console.log(respuesta);
            
            $('#nombreEditar').val(respuesta.cliente)
            $('#idCliente').val(respuesta.id)
            $('#documentoEditar').val(respuesta.documento)
            $('#emailEditar').val(respuesta.email)
            $('#telefonoEditar').val(respuesta.telefono)
            $('#direccionEditar').val(respuesta.direccion)
            $('#fecha_nacEditar').val(respuesta.fecha_nac)

            
        }
    })
})



$("#documentoEditar").change(function () {    

    $(".alert").remove()
    
    var document = $(this).val()

    var Cid = $("#idEditar").val()

    $.ajax({

        url: 'Validar-Documento',
        type: 'POST',
        data: {documento: document, id:Cid},
        success: function (respuesta) {
            if (!respuesta) {
                $("#documentoEditar").parent().after('<div class="alert alert-danger">Documento existe</div>')
            } else {
                console.log("holis");
                
            }
           
        }
    })
})


//ELIMINAR PRODUCTOS
$(".table").on('click', '.btnEliminarCliente', function () {

    var Cid = $(this).attr('idCliente')
    var cliente = $(this).attr('cliente')

    Swal.fire({

        title: '¿Eliminar Cliente: '+ cliente +'?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
    }).then((result)=> {

        if (result.isConfirmed) {
            
            window.location = "Eliminar-Cliente/"+Cid
        }
    })
})