@extends('master')
@section('title', 'La Union')
@section('styles')
  @include('layouts/styles')
  
@endsection
@section('content')
    @include('layouts/flash')
           <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Vehiculos</h3>
                </div><!-- /.box-header -->
                <form id="busquedaVehiculos"></form>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-10">
                    </div>
                    <div class="col-sm-2">
                        <br>
                          @if(Session::get('datos-loggeo')->id_rol == 1)
                            <a type="button" href="{{route('cargarVehiculo')}}" class="btn btn-block btn-success" style="margin-top: 5px;width:70%;">Agregar Ingreso</a>
                          @endif
                    </div>
                </div>
                <br>
                <div class="box-body">
                  <table id="vehiculos" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Cliente</th>
                        <th>Color</th>
                        <th>Año</th>
                        <th>Chapa</th>
                        <th>Combustible</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@endsection

@section('scripts')
@include('layouts/scripts')    
    <script type="text/javascript" src="{{asset('assets/bootstrap/js/jquery.serializejson.js')}}"></script>
    <script type="text/javascript">
            $("#vehiculos").dataTable({
                    'processing': true,
                    "destroy": true,
                    "ajax": {
                        "url": "{{route('getVehiculos')}}",
                        "data": $('#busquedaVehiculos').serializeJSON() 
                    },
                    "columns":[
                                {
                                    data: "marca.denominacion",
                                    defaultContent: ""
                                },
                                 {
                                    data: "modelo.nombre",
                                    defaultContent: ""
                                },
                                {
                                    data: "cliente.nombre",
                                    defaultContent: ""
                                },
                                {
                                    data: "color",
                                    defaultContent: ""
                                },
                                {
                                    data: "anho",
                                    defaultContent: ""
                                },
                                {
                                    data: "chapa",
                                    defaultContent: ""
                                },
                                {
                                    data: "combustible",
                                    defaultContent: ""
                                },
                                {data: function(x) {
                                    @if(Session::get('datos-loggeo')->id_rol == 1)
                                      acciones = `<div class="btn-group">`;
                                      acciones += `<button type="button" style="width: 71px;" class="btn btn-success btn-flat">Abierto</button>`;
                                      acciones += `<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">`;
                                      acciones += `<span class="caret"></span>`;
                                      acciones += `<span class="sr-only">Toggle Dropdown</span>`;
                                      acciones += `</button>`;
                                      acciones += `<ul class="dropdown-menu" role="menu">`;
                                      acciones += `<li><a href="#">Editar</a></li>`;
                                      acciones += `<li><a href="#">Cargar Repuestos</a></li>`;
                                      acciones += `<li><a href="#">Cargar Reparaciones</a></li>`;
                                      acciones += `<li class="divider"></li>`;
                                      acciones += `</ul>`;
                                      acciones += `</div>`;
                                    @endif;
                                    @if(Session::get('datos-loggeo')->id_rol == 2)
                                      acciones = `<div class="btn-group">`;
                                      acciones += `<button type="button" style="width: 71px;" class="btn btn-info btn-flat">Recepcion</button>`;
                                      acciones += `<button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">`;
                                      acciones += `<span class="caret"></span>`;
                                      acciones += `<span class="sr-only">Toggle Dropdown</span>`;
                                      acciones += `</button>`;
                                      acciones += `<ul class="dropdown-menu" role="menu">`;
                                      acciones += `<li><a href="#">Cargar Datos</a></li>`;
                                      acciones += `</ul>`;
                                      acciones += `</div>`;
                                    @endif
                                    @if(Session::get('datos-loggeo')->id_rol == 2)
                                      acciones = `<div class="btn-group">`;
                                      acciones += `<button type="button" style="width: 71px;" class="btn btn-warning btn-flat">Recepcion</button>`;
                                      acciones += `<button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown">`;
                                      acciones += `<span class="caret"></span>`;
                                      acciones += `<span class="sr-only">Toggle Dropdown</span>`;
                                      acciones += `</button>`;
                                      acciones += `<ul class="dropdown-menu" role="menu">`;
                                      acciones += `<li><a href="#">Cargar Datos</a></li>`;
                                      acciones += `<li><a href="#">Cargar Reparaciones</a></li>`;
                                      acciones += `</ul>`;
                                      acciones += `</div>`;
                                    @endif
                                    return acciones;
                                }}
                          ],
                    "aaSorting":[[0,"desc"]],   
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
            })

    
    </script>

@endsection
