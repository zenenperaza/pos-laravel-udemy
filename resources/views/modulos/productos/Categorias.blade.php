@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Categorias</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria" >Agregar Categoria</button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($categorias as $key => $categoria)

            
                                
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>
                                        <button class="btn btn-warning btnEditarCategoria" data-toggle="modal" data-target="#modalEditarCategoria" idCategoria="{{ $categoria->id }}"><i class="fa fa-pencil"></i></button>
                                        
                                        <button class="btn btn-danger btnEliminarCategoria"  idCategoria="{{ $categoria->id }}" categoria="{{ $categoria->nombre }}"><i class="fa fa-trash"></i></button>


                                    </td>
                                </tr>
                                
                     
                        
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="modalAgregarCategoria">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="post">

                @csrf

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Categoria</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" name="nombre" id="" class="form-control input-lg" placeholder="Ingresar Categoria" required>    

                            </div>

                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                    
                    <button class="btn btn-primary" type="submit" >Agregar Categoria</button>


                </div>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" id="modalEditarCategoria">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ url('Actualizar-Categoria') }}" method="post">

                @csrf
                @method('put')

                <div class="modal-header" style="background: #ffc107; color:black">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Categoria</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" name="nombre"class="form-control input-lg" id="nombreEditar" required>    

                                <input type="hidden" name="id" class="form-control input-lg" id="idEditar" required>    

                            </div>

                          
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                    
                    <button class="btn btn-success" type="submit" >Guardar cambios</button>


                </div>

            </form>

        </div>

    </div>

</div>
    
    
    
@endsection