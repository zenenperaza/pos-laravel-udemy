<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('Inicio') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="{{ url('storage/plantilla/icono-blanco.png') }}" alt="" class="img-responsive" style="padding: 10px">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="{{ url('storage/plantilla/logo-blanco-lineal.png') }}" alt="" class="img-responsive" style="padding: 10px 0px">
 
      </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
    
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;">
           
              @if (auth()->user()->foto == '')

                <img src="{{ url('storage/users/anonymous.png') }}" class="img-circle" alt="User Image" style="width: 25px">

              @else

                <img src="{{ url('storage/'.auth()->user()->foto) }}" class="img-circle" alt="User Image" style="width: 25px">

              @endif  
            <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                @if (auth()->user()->foto == '')

                   <img src="{{ url('storage/users/anonymous.png') }}" class="img-circle" alt="User Image" >

                @else
                   <img src="{{ url('storage/'.auth()->user()->foto) }}" class="img-circle" alt="User Image" >

                @endif
               
                <p>
                  {{ auth()->user()->name }} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('Mis-Datos') }}" class="btn btn-default btn-flat">Mi perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-danger btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                </div>

                <form id="logout-form" method="post"  action="{{ route('logout') }}" >
                  @csrf
                </form>
              </li>
            </ul>
          </li>

        </ul>
      </div>

    </nav>
  </header>