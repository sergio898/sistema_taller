<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Taller La Union</title>
    @section('styles') 
       @include('layouts/styles')
    @show
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      @include('layouts/headers')
      @include('layouts/aside_menu')

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
          @yield('content')
      </div><!-- /.content-wrapper -->
      @include('layouts/footer')
    </div><!-- ./wrapper -->

    @section('scripts')
     @include('layouts/scripts')
    @show
  </body>
</html>