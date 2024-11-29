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
                  <h3 class="box-title">Carga de Mecanico</h3>
                </div><!-- /.box-header -->
                <form id="cargaMecanico" method="post" action="{{route('doMecanico')}}" autocomplete="off">
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

                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <h4 class="box-title">Reparaciones</h4>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <h4 class="box-title">Repuestos</h4>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-5">
                                <label>Reparaciones</label>
                                <input type="text" name="danho" id="danho" class="form-control" placeholder="Daños"/>
                            </div>
                            <div class="col-sm-1">
                              <br>
                              <button type="button" id="procesarFilaD" class="btn btn-block btn-success" style="margin-top: 5px;width: 60px;">+</button>
                            </div>
                            <div class="col-sm-1">
                                <label>Cant.</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Cant."/>
                            </div>
                            <div class="col-sm-4">
                                <label>Repuesto</label>
                                <select class="form-control select2" name="repuesto" id="repuesto" style="width: 100%;">
                                    <option value="">Seleccione Repuesto</option>
                                    @foreach($repuestos as $repuesto)
                                         <option value="{{$repuesto->id}}">{{$repuesto->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-1">
                              <br>
                              <button type="button" id="procesarFilaR" class="btn btn-block btn-success" style="margin-top: 5px;width: 60px;">+</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div id="divDanhos" class="col-sm-6">
                            </div>
                            <div id="divRepuesto" class="col-sm-6">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-10">
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button type="button" id="procesar" class="btn btn-block btn-success" style="margin-top: 5px;">Guardar</button>
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
        $("#procesarFilaR").click(() => {
            procesarFilaR()
        });

        function procesarFilaR(){
              var cantidad = $('.filaR').length;
              var cantFila = cantidad+ 1;
              var repuesto = $('select[name="repuesto"] option:selected').text();
              var id_repuesto = $("#repuesto").val();
              var cantidad = $("#cantidad").val();
              input = `<div class="row filaR" style="margin-top: 10px;">`;
              input += `<div class="col-sm-2">`;
              input += `<input type="text" name="base[`+cantFila+`][cantiddad]" class="form-control repuestos" value="`+cantidad+`" disabled/>`;
              input += `</div>`;
              input += `<div class="col-sm-8">`;
              input += `<input type="hidden" name="base[`+cantFila+`][id_repuesto]" class="form-control repuestos" value="`+id_repuesto+`" disabled/>`;
              input += `<input type="text" name="base[`+cantFila+`][repuesto]" class="form-control repuestos" value="`+repuesto+`" disabled/>`;
              input += `</div>`;
              input += `<div class="col-sm-1">`;
              input += `<button type="button" id="eliminar_fila`+cantFila+`" class="btn btn-block btn-danger eliminarFilaR" style="margin-top: 5px;width: 60px;">-</button>`;
              input += `</div>`;
              input += `</div>`;
             $("#divRepuesto").append(input);
             $("#cantidad").val('');
             $('#repuesto').val('').trigger('change.select2');
        }

        $("#procesarFilaD").click(() => {
            procesarFilaD()
        });

        function procesarFilaD(){
              var cantidad = $('.filaD').length;
              var cantFila = cantidad+ 1;
              var danho = $("#danho").val();
              input = `<div class="row filaD" style="margin-top: 10px;">`;
              input += `<div class="col-sm-10">`;
              input += `<input type="text" name="datos[`+cantFila+`][danho]" class="form-control danho" value="`+danho+`" disabled/>`;
              input += `</div>`;
              input += `<div class="col-sm-1">`;
              input += `<button type="button" id="eliminar_filaD`+cantFila+`" class="btn btn-block btn-danger eliminarFilaD" style="margin-top: 5px;width: 60px;">-</button>`;
              input += `</div>`;
              input += `</div>`;
             $("#divDanhos").append(input);
             $("#danho").val('');
        }

        $("#procesar").click(() => {
            $(".danho").attr("disabled",false);
            $(".repuestos").attr("disabled",false);
            $('#cargaMecanico').submit(); 
        });

    </script>

@endsection
