<header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b>La Union</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">{{Session::get('datos-loggeo')->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                    <p>
                      {{Session::get('datos-loggeo')->rol}}
                      <small>Creado el  {{date('d/m/y h:m:s', strtotime(Session::get('datos-loggeo')->created_at))}}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                             {{ __('Salir') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>