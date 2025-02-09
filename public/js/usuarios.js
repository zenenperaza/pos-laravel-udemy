$(".selectRol").change(function(){

    var Rol = $(this).val();

    if(Rol != 'Admin'){

        $(".selectSucursal").show()
    } else {

        $(".selectSucursal").hide()
    }
})


$(".table").on('click', '.btnEstadoUser', function(){

    var Uid = $(this).attr('Uid')
    var estado = $(this).attr('estado')

    console.log(Uid)
    if (estado == 0) {
        $(this).removeClass('btn-success').addClass('btn-danger').attr('estado', 1).text('Desactivado')
    } else {
        
        $(this).removeClass('btn-danger').addClass('btn-success').attr('estado', 0).text('Activado')
    }

    $.ajax({

        url: 'Cambiar-Estado-Usuario/'+Uid+'/'+estado,
        type: 'GET',
        success: function(){
console.log(estado);

            if (estado == 0) {
                $(this).removeClass('btn-success').addClass('btn-danger').attr('estado', 1).text('Desactivado')
            } else {
                
                $(this).removeClass('btn-danger').addClass('btn-success').attr('estado', 0).text('Activado')
            }
        }.bind()
    })
})

$(".table").on('click', '.btnEditarUsuario', function () {
    
    var Uid = $(this).attr('idUsuario')

    // console.log(Uid);
    

    $.ajax({

        url: 'Editar-Usuario/'+Uid,
        type: 'GET',
        success: function(respuesta){
            $('#nameEditar').val(respuesta.name)
            $('#rolEditar').val(respuesta.rol)
            $('#emailEditar').val(respuesta.email)
            $('#idEditar').val(respuesta.id)

            if (respuesta.rol != 'Admin') {
                
                $(".selectSucursal").show()
                $("#id_sucursalEditar").val(respuesta.id_sucursal)

            } else {
                
                $(".selectSucursal").hide()
                
            }
        }
    })
})

$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }
})



$("#emailEditar").change( function() {

    var emailVerificar = $(this).val();
    var idUser = $("#idEditar").val();

    $(".alert").remove();

    // console.log(emailVerificar);
    

    $.ajax({

        url: 'Verificar-Usuario',
        type: 'POST',
        data: {email: emailVerificar, id: idUser},

        success: function (respuesta) {

            

            if (respuesta["emailVerificacion"] == false) {

                $("#emailEditar").parent().after('<div class="alert alert-danger">Email ya existente</div>')
                $("#emailEditar").val("")
            }
            
         
        }

    })


    
})


$(".table").on('click', '.btnEliminarUsuario', function(){
    
    var Uid = $(this).attr('idUsuario')

    Swal.fire({

        title: '¿Eliminar Usuario  ?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        confirmButtonColor: '#3085d6'
    }).then((result)=> {

        if (result.isConfirmed) {
            
            window.location = "Eliminar-Usuario/"+Uid
        }
    })
})