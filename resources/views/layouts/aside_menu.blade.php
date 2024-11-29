 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Vehiculos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('listadosVehiculos')}}"><i class="fa fa-circle-o"></i> Vehiculos</a></li>
                @if(Session::get('datos-loggeo')->id_rol == 1 || Session::get('datos-loggeo')->id_rol == 2)
                  <li><a href="{{route('listadoMarcas')}}"><i class="fa fa-circle-o"></i> Marcas</a></li>
                  <li><a href="{{route('listadoModelos')}}"><i class="fa fa-circle-o"></i> Modelos</a></li>
                @endif
              </ul>
            </li>
            @if(Session::get('datos-loggeo')->id_rol == 1 || Session::get('datos-loggeo')->id_rol == 2)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Personas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  @if(Session::get('datos-loggeo')->id_rol == 1 || Session::get('datos-loggeo')->id_rol == 2)
                    <li><a href="{{route('listadosCliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                  @endif
                  @if(Session::get('datos-loggeo')->id_rol == 1)
                    <li><a href="{{route('listadosUsuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  @endif
                </ul>
              </li>
            @endif
            @if(Session::get('datos-loggeo')->id_rol == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Administración</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Productos</a></li>
                  <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Seguro</a></li>
                  <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Accesorios</a></li>
                </ul>
              </li>
            @endif
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>