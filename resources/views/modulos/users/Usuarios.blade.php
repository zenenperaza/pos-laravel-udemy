@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Gestor de Usuarios</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario">Add Users</button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped table-hover dt-responsive">

                    <thead>

                        <tr>

                            <th style="width: 10px">#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <td>Sucursal</td>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Ultimo Login</th>
                            <th>Acciones</th>                            
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($usuarios as $key => $user)

                                
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td> 
                                        @if ($user->foto != '')
                                            <img src="{{ url('storage/' . $user->foto) }}" alt="" class="img-thumbnail" width="40px">
                                        @else
                                            <img src="{{ url('storage/users/anonymous.png') }}" alt="" class="img-thumbnail" width="40px">
                                       
                                        @endif 
                                    </td>
                                    <td>

                                        @if ($user->rol != 'Admin')
                                            {{ $user->SUCURSAL->nombre }}
                                        @endif

                                    </td>
                                    <td>{{ $user->rol }}</td>
                                    <td>
                                        @if ($user->estado == 1)
                                            <button class="btn btn-success btn-xs btnEstadoUser" Uid="{{ $user->id }}" estado="0">Activado</button>
                                        @else
                                        <button class="btn btn-danger btn-xs btnEstadoUser" Uid="{{ $user->id }}" estado="1">Desactivado</button>
                                            
                                        @endif
                                    </td>
                                    <td>{{ $user->ultimo_login }}</td>
                                    <td>
                                        <button class="btn btn-warning btnEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario" idUsuario="{{ $user->id }}"><i class="fa fa-pencil"></i> </button>
                                        <button class="btn btn-danger btnEliminarUsuario"  idUsuario="{{ $user->id }}"><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                                
                        
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="modalCrearUsuario">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar usuario</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" name="name" id="" class="form-control input-lg" placeholder="Ingresar nombre" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" name="email" id="" class="form-control input-lg" placeholder="Ingresar E-Mail" required>    

                            </div>
                          
                        </div>

                        @error('email')
                        <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                            
                        @enderror

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" name="password" id="" class="form-control input-lg" placeholder="Ingresar Contrasena" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                
                                <select name="rol" id="" class="form-control input-lg selectRol">
                                    <option value="">Seleccione rol</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Encargado">Encargado</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>

                            </div>
                          
                        </div>

                        <div class="form-group selectSucursal" style="display: none">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                
                                <select name="id_sucursal" id="" class="form-control input-lg">
                                    <option value="">Seleccione Suscursal</option>

                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                    
                                </select>

                            </div>
                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Usuario</button>


                </div>

            </form>

        </div>

    </div>

</div>
 

<div class="modal fade" id="modalEditarUsuario">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ url('Actualizar-Usuario') }}" method="post">

                @csrf
                @method('put')

                <div class="modal-header" style="background: #ffc107; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar usuario</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" name="name" id="nameEditar" class="form-control input-lg" placeholder="Ingresar nombre" required>  

                                <input type="hidden" name="id" id="idEditar">    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" name="email" id="emailEditar" class="form-control input-lg" placeholder="Ingresar E-Mail" required>    

                            </div>
                          
                        </div>

                        @error('email')
                        <p class="alert alert-danger">El Email ya se encuentra registrado</p>
                            
                        @enderror

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" name="password" id="passwordEditar" class="form-control input-lg" placeholder="Ingresar Contrasena" required>    

                            </div>
                          
                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                
                                <select name="rol" id="rolEditar" class="form-control input-lg selectRol">
                                    <option value="">Seleccione rol</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Encargado">Encargado</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>

                            </div>
                          
                        </div>

                        <div class="form-group selectSucursal" style="display: none">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                
                                <select name="id_sucursal" id="id_sucursalEditar" class="form-control input-lg">
                                    <option value="">Seleccione Suscursal</option>

                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                    @endforeach
                                    
                                </select>

                            </div>
                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                    
                    <button class="btn btn-success" type="submit" >Guardar Usuario</button>


                </div>

            </form>

        </div>

    </div>

</div>
    
    
@endsection