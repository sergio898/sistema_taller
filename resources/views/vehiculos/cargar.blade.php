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
                  <h3 class="box-title">Carga de Vehiculo</h3>
                </div><!-- /.box-header -->
                <form id="cargaVehiculos" method="post" action="{{route('doCarga')}}" autocomplete="off">
                    @csrf
                    <div class="box-body">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="datemask" name="fecha_entrada"  class="form-control" value="{{date('d/m/Y')}}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-6">
                                <label>Cliente</label>
                                <select class="form-control select2" name="cliente" id="formTipoProv" style="width: 100%;">
                                    <option value="">Seleccione Cliente</option>
                                    @foreach($clientes as $cliente)
                                         <option value="{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellido}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Marca</label>
                                <select class="form-control select2" name="marca" id="marca" style="width: 100%;">
                                    <option value="">Seleccione Marca</option>
                                    @foreach($marcas as $marca)
                                         <option value="{{$marca->id}}">{{$marca->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Modelo</label>
                                <select class="form-control select2" name="modelo" id="modelo" style="width: 100%;">
                                    <option value="">Seleccione Modelo</option>
                                    @foreach($modelos as $modelo)
                                         <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Color</label>
                                <input type="text" name="color" class="form-control" placeholder="Color"/>
                            </div>
                            <div class="col-sm-6">
                                <label>Año</label>
                                <input type="numeric" name="anho" class="form-control" placeholder="Año"/>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Chapa</label>
                                <input type="text" name="chapa" class="form-control" placeholder="Chapa"/>
                            </div>
                            <div class="col-sm-6">
                                <label>Combustible</label>
                                <select class="form-control select2" name="combustible" id="combustible" style="width: 100%;">
                                    <option value="">Seleccione Combustible</option>
                                    <option value="Diésel">Diésel</option>
                                    <option value="Gasolina">Gasolina</option>
                                    <option value="Híbridos">Híbridos</option>
                                    <option value="Eléctrico">Eléctrico</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Kilometraje</label>
                                <input type="text" name="km" class="form-control" placeholder="Kilometraje"/>
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <label style="padding-top: 10px;">
                                    <input type="checkbox" id="tiene_seguro" onclick='verSeguro()' class="minimal"/>
                                     Tiene seguro?
                                </label>
                            </div>
                            <div class="col-sm-4" id="divSeguro" style="display:none">
                                <label>Seguro</label>
                                <select class="form-control select2" name="seguro" id="seguro" style="width: 100%;">
                                    <option value="">Seleccione Seguro</option>
                                    @foreach($seguros as $seguro)
                                         <option value="{{$seguro->id}}">{{$seguro->denominacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-sm-6">
                                <label>Recepcionista</label>
                                <select class="form-control select2" name="recepcionista" id="recepcionista" style="width: 100%;">
                                    <option value="">Seleccione Recepcionista</option>
                                    @foreach($recepcionistas as $recepcionista)
                                         <option value="{{$recepcionista->id}}">{{$recepcionista->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-3">
                                <br>
                                <button id="procesar" type="button" class="btn btn-block btn-success" style="margin-top: 5px;">Guardar</button>
                            </div>
                        </div>
                        <br>
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

        function verSeguro(){
            if($('#tiene_seguro').is(':checked')){
				$('#divSeguro').css('display', 'block');;	
			}else{
                $('#divSeguro').css('display', 'none');
            }
        }

        $('#marca').change(function(){ 
            buscarMarca()
        })  

        function buscarMarca(){
            valor = $("#marca").val();
            if(valor != 0){
                dataString = "dataFile="+valor;
                $.ajax({
                        type: "GET",
                        url: "{{route('getModelo')}}",
                        dataType: 'json',
                        data: dataString,
                        success: function(rsp){
                            $("#modelo").empty();
                            var next_id = $("#modelo");
                            $(next_id).append($("<option></option>").attr("value", '').text('Seleccione Modelo'));
                            $.each(rsp, function(key, value) {
                                $(next_id).append($("<option></option>").attr("value", value.id).text(value.nombre));
                            });
                            $('#modelo').formSelect();
                        }
                })
            }
        } 

        $("#procesar").click(() => {
            $('#cargaVehiculos').submit(); 
        });




    </script>

@endsection
