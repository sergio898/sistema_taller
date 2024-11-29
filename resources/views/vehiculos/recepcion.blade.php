@extends('master')
@section('title', 'La Union')
@section('styles')
  @include('layouts/styles')
@endsection
@section('content')
           <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Carga de Recepción</h3>
                </div><!-- /.box-header -->
                <form id="busquedaRecepcion" method="post" action="{{route('doRecepcion')}}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" class="form-control"  value="{{$visita->id}}"/>
                    <div class="box-body">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Fecha de Entrada</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="datemask" name="fecha_entrada"  class="form-control" value="{{date('d/m/Y',strtotime($visita->fecha_alta))}}" data-inputmask="'alias': 'dd/mm/yyyy'" disabled/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-6">
                                <label>Cliente</label>
                                <input type="text" name="color" class="form-control" placeholder="Cliente" value="{{$visita->cliente->nombre}} {{$visita->cliente->apellido}}" disabled/>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Marca / Modelo</label>
                                <input type="text" name="color" class="form-control" placeholder="Vehiculo" value="{{$visita->marca->denominacion}} / {{$visita->modelo->nombre}}" disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label>Año / Color</label>
                                <input type="text" name="color" class="form-control" placeholder="Vehiculo" value="{{$visita->anho}} / {{$visita->color}}" disabled/>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Chapa / Kilometraje</label>
                                <input type="text" name="color" class="form-control" placeholder="Vehiculo" value="{{$visita->chapa}} / {{$visita->km}}" disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label>Combustible</label>
                                <input type="text" name="color" class="form-control" placeholder="Vehiculo" value="{{$visita->combustible}}" disabled/>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Seguro</label>
                                <input type="text" name="color" class="form-control" placeholder="Vehiculo" value="{{$visita->seguro->denominacion}}" disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label>Mecanico</label>
                                <select class="form-control select2" name="mecanico" id="mecanico" style="width: 100%;">
                                    <option value="">Seleccione Mecanico</option>
                                    @foreach($mecanicos as $mecanico)
                                         <option value="{{$mecanico->id}}">{{$mecanico->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h4 class="box-title">Daños</h4>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-11">
                                <label>Descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion"/>
                            </div>
                            <div class="col-sm-1">
                              <br>
                              <button type="button" id="procesarFila" class="btn btn-block btn-success" style="margin-top: 5px;width: 60px;">+</button>
                            </div>
                        </div>
                        <div id="divDanhos">
                        </div>
                        <h4 class="box-title">Accesorios</h4>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-4">
                                <label>Accesorio</label>
                                <select class="form-control select2" name="accesorio" id="accesorio" style="width: 100%;">
                                    <option value="">Seleccione Accesorio</option>
                                    @foreach($accesorios as $accesorio)
                                         <option value="{{$accesorio->id}}">{{$accesorio->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <label>Observacion</label>
                                <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Observacion"/>
                            </div>
                            <div class="col-sm-1">
                              <br>
                              <button type="button" id="procesarFila" class="btn btn-block btn-success" style="margin-top: 5px;width: 60px;">+</button>
                            </div>
                        </div>
                        <div id="divAccesorio">
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <label>Observacion</label>
                                <textarea class="textarea" name="observacion_recepcion" placeholder="Observaciones" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-10">
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button id="procesar" type="button" class="btn btn-block btn-success"style="margin-top: 5px;">Guardar</button>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@endsection

@section('scripts')
@include('layouts/scripts')    
    <script type="text/javascript" src="{{asset('assets/bootstrap/js/jquery.serializejson.js')}}"></script>
    <script type="text/javascript">
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        $(".select2").select2();
        $(".textarea").wysihtml5();
        
        $("#procesarFila").click(() => {
            porcesarFila()
        });

        function porcesarFila(){
              var cantidad = $('.fila').length;
              var cantFila = cantidad+ 1;
              var accesorio = $('select[name="accesorio"] option:selected').text();
              var id_accesorio = $("#accesorio").val();
              var observacion = $("#observacion").val();
              input = `<div class="row fila" style="margin-top: 10px;">`;
              input += `<div class="col-sm-4">`;
              input += `<input type="hidden" name="datos[`+cantFila+`][id_accesorio]" class="form-control accesorios" value="`+id_accesorio+`" disabled/>`;
              input += `<input type="text" name="datos[`+cantFila+`][accesorio]" class="form-control accesorios" value="`+accesorio+`" disabled/>`;
              input += `</div>`;
              input += `<div class="col-sm-7">`;
              input += `<input type="text" name="datos[`+cantFila+`][observacion]" class="form-control accesorios" value="`+observacion+`" disabled/>`;
              input += `</div>`;
              input += `<div class="col-sm-1">`;
              input += `<button type="button" id="eliminar_fila`+cantFila+`" class="btn btn-block btn-danger eliminarFila" style="margin-top: 5px;width: 60px;">-</button>`;
              input += `</div>`;
              input += `</div>`;
             $("#divAccesorio").append(input);
             $("#observacion").val('');
             $('#accesorio').val('').trigger('change.select2');
        }

        $("#procesar").click(() => {
            $(".accesorios").attr("disabled",false);
            $('#busquedaRecepcion').submit(); 
        });
        

    </script>

@endsection
