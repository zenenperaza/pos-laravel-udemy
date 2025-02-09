@extends('welcome')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Mi perfil</h1>

    </section>

    <section class="content">

        <div class="box">      

            <div class="box-body">

                <form action="" method="post" enctype="multipart/form-data">

                    @csrf

                    
                
                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-users"></i></span>

                            <input type="text" name="name" id="" class="form-control input-lg" required value="{{ auth()->user()->name }}">

                        </div>

                    </div>

                    
                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-send"></i></span>

                            <input type="email" name="email" id="" class="form-control input-lg" required value="{{ auth()->user()->email }}">

                        </div>

                        @error('email')
                            <p class="alert alert-danger">El Mail se encuentra registrado</p>                            
                        @enderror
                        
                    </div>

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                            <input type="password" name="password" id="" class="form-control input-lg" >

                        </div>
                        
                    </div>
                    
                    <div class="form-group">

                            <input type="file" name="fotoPerfil" id="" class="form-control input-lg" >

                            <br>

                            @if (auth()->user()->foto != '')

                                <img src="{{ url('storage/'.auth()->user()->foto) }}" alt="" width="150px">                        
                                
                            @else

                                <img src="{{ url('storage/users/anonymous.png') }}" alt="" width="150px">                        
                                
                            @endif

                           
                    </div>

                    <div class="box-footer">

                        <button type="submit" class="btn btn-success pull-right">Guardar</button>
                    </div>
                
                </form>

            </div>

        </div>

    </section>

</div>


    
@endsection