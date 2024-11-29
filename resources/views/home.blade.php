@extends('master')
@section('title', 'La Union')
@section('styles')
  @include('layouts/styles')
  
@endsection
@section('content')
    @include('layouts/flash')
      <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        @if(Session::get('datos-loggeo')->id_rol == 1)
          <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>150</h3>
                    <p>Vehiculos Activos</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>53</h3>
                    <p>Vehiculos Recepcionados</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>44</h3>
                    <p>Vehiculos Finalizados</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>65<sup style="font-size: 20px">%</sup></h3>
                    <p>% Finalizacion</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                  <!-- Tabs within a box -->
                  <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> HISTORICO MENSUAL VEHICULO</li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                  </div>
                </div><!-- /.nav-tabs-custom -->

              </section><!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->
              <section class="col-lg-5 connectedSortable">

                <!-- Map box -->
                <div class="box box-solid bg-light-blue-gradient">
                  <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                      <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                      <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->

                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">
                      HISTORICO DE CLIENTES
                    </h3>
                  </div>
                  <div class="box-body">
                    <div id="world-map" style="height: 250px; width: 100%;"></div>
                  </div><!-- /.box-body-->
                  <div class="box-footer no-border">
                    <div class="row">
                      <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                        <div id="sparkline-1"></div>
                        <div class="knob-label">Visitors</div>
                      </div><!-- ./col -->
                      <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                        <div id="sparkline-2"></div>
                        <div class="knob-label">Online</div>
                      </div><!-- ./col -->
                      <div class="col-xs-4 text-center">
                        <div id="sparkline-3"></div>
                        <div class="knob-label">Exists</div>
                      </div><!-- ./col -->
                    </div><!-- /.row -->
                  </div>
                </div>
                <!-- /.box -->
              </section><!-- right col -->
            </div><!-- /.row (main row) -->

          </section><!-- /.content -->
        @endif
        @if(Session::get('datos-loggeo')->id_rol == 2)
          <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>150</h3>
                    <p>Vehiculos Activos</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>53</h3>
                    <p>Vehiculos Recepcionados</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>44</h3>
                    <p>Vehiculos Finalizados</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>65<sup style="font-size: 20px">%</sup></h3>
                    <p>% Finalizacion</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-7 connectedSortable">
              

              </section><!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->
              <section class="col-lg-5 connectedSortable">

              </section><!-- right col -->
            </div><!-- /.row (main row) -->

          </section><!-- /.content -->
        @endif
        @if(Session::get('datos-loggeo')->id_rol == 3)
          <section class="content">
            <br>
            <br>
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-7 connectedSortable">
                 <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Vehiculos Activos</h3>
                        </div><!-- /.box-header -->
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
                                <th>Recepcionista</th>
                              </tr>
                            </thead>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
              </section><!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->
              <section class="col-lg-5 connectedSortable">
              <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Vehiculos Finalizados en el Mes</h3>
                        </div><!-- /.box-header -->
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
                                <th>Recepcionista</th>
                              </tr>
                            </thead>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->

              </section><!-- right col -->
            </div><!-- /.row (main row) -->

          </section><!-- /.content -->
        @endif
@endsection

@section('scripts')
@include('layouts/scripts')    
    <script type="text/javascript" src="{{asset('assets/bootstrap/js/jquery.serializejson.js')}}"></script>
    <script type="text/javascript">
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        $(".select2").select2();


    </script>

@endsection
