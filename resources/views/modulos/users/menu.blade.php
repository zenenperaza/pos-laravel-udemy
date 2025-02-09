<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (auth()->user()->foto == '')

                <img src="{{ url('storage/users/anonymous.png') }}" class="img-circle" alt="User Image">

              @else
              <img src="{{ url('storage/'.auth()->user()->foto) }}" class="img-circle" alt="User Image">

              @endif   <span class="hidden-xs">{{ auth()->user()->name }}</span>

        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li >

          <a href="{{ url('Inicio') }}">
            <i class="fa fa-home"></i>
            <span>Inicio</span>
       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Usuarios') }}">
            <i class="fa fa-users"></i>
            <span>Usuarios</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Sucursales') }}">
            <i class="fa fa-building"></i>
            <span>Sucursales</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Categorias') }}">
            <i class="fa fa-th"></i>
            <span>Categorias</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Productos') }}">
            <i class="fa fa-cube"></i>
            <span>Productos</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Clientes') }}">
            <i class="fa fa-user-plus"></i>
            <span>Clientes</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Ventas') }}">
            <i class="fa fa-shopping-cart"></i>
            <span>Adminstrar Ventas</span>       
          </a>
                  
        </li>

        <li >
          <a href="{{ url('Reportes') }}">
            <i class="fa fa-bar-chart"></i>
            <span>Reportes</span>       
          </a>
                  
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>