<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Modelo;
use App\Models\Marca;
use App\Models\Seguro;
use App\Models\User;
use App\Models\VisitaVehiculo;
use App\Models\Accesorio;
use App\Models\VisitaAccesorio;
use App\Models\Repuesto;
use App\Models\VisitaRepuesto;
use App\Models\VisitaDanho;
use DB;
use Session;
use Redirect;

class VehiculoController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('vehiculos.index');
    }

    public function getVehiculos(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(300);  
        
        $ajax = 0;
        $formSearch = $request->dataString;
        $draw = intval($request->draw);
        $start = intval($request->start);
        $length = intval($request->length);
        $filtrarMax = 0;

        if(Session::get('datos-loggeo')->id_rol == 1){
            $results = VisitaVehiculo::with('cliente','marca','modelo','seguro')->get();
        }

        if(Session::get('datos-loggeo')->id_rol == 2){
            $results = VisitaVehiculo::with('cliente','marca','modelo','seguro')->where('id_recepcionista', Session::get('datos-loggeo')->cod_usuario)->get();
        }

        if(Session::get('datos-loggeo')->id_rol == 3){
            $results = VisitaVehiculo::with('cliente','marca','modelo','seguro')->where('id_mecanico', Session::get('datos-loggeo')->cod_usuario)->get();
        }

        $cantidadTransaccion = count($results);
        $resultTransacciones = array();
        $btn = '';
        $cont = 0;
        foreach ($results as $key => $result) 
        {
            if($cont == $length)
            {
            break;
            }

            if($key >= $start)
            {
                $resultTransacciones[] = $result;
                $cont++;
            }  
        }
        return response()->json(array(  'data'=>$results,
                                        'draw'=>$draw,
                                        'recordsTotal'=>$cantidadTransaccion,
                                        'recordsFiltered'=>$cantidadTransaccion));
    }

    public function cargarVehiculo()
    {
        $clientes = Cliente::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $seguros = Seguro::all();
        $recepcionistas = User::where('id_rol', 2)->get();
        return view('vehiculos.cargar')->with([
                                                'clientes'=>$clientes,
                                                'modelos'=>$modelos,
                                                'seguros'=>$seguros,
                                                'marcas'=>$marcas,
                                                'recepcionistas'=>$recepcionistas
                                                ]);
    }

    public function getModelo(Request $request){
        $modelos = Modelo::where('id_marca', $request->input('dataFile'))->get();
        return response()->json($modelos);
    }

    public function cargarRecepcionista(Request $request,$id)
    {
        $visita = VisitaVehiculo::with('cliente','marca','modelo','seguro')->where('id', $id)->first();
        $mecanicos = User::where('id_rol', 3)->get();
        $accesorios = Accesorio::all();
        return view('vehiculos.recepcion')->with([
                                                'visita'=>$visita,
                                                'mecanicos'=>$mecanicos,
                                                'accesorios'=>$accesorios
                                                ]);
    }

    public function cargarMecanico(Request $request,$id)
    {
        $visita = VisitaVehiculo::with('cliente','marca','modelo','seguro')->where('id', $id)->first();
        $repuestos = Repuesto::all();
        return view('vehiculos.mecanico')->with([
                                                'visita'=>$visita,
                                                'repuestos'=>$repuestos
                                                ]);
    }

    public function doCarga(Request $request){
        try{
            $visitaVehiculo = new VisitaVehiculo;
            $visitaVehiculo->fecha_alta = date('Y-m-d',strtotime($request->input('fecha_entrada'))); 
            $visitaVehiculo->id_cliente = $request->input('cliente'); 
            $visitaVehiculo->id_marca = $request->input('marca'); 
            $visitaVehiculo->id_modelo = $request->input('modelo'); 
            $visitaVehiculo->color = $request->input('color'); 
            $visitaVehiculo->anho = $request->input('anho'); 
            $visitaVehiculo->chapa = $request->input('chapa'); 
            $visitaVehiculo->combustible = $request->input('combustible'); 
            $visitaVehiculo->km = $request->input('km'); 
            $visitaVehiculo->id_recepcionista = $request->input('recepcionista'); 
            $visitaVehiculo->fecha_recepcion = date('Y-m-d H:m:s'); 
            $visitaVehiculo->id_seguro = $request->input('seguro'); 
            $visitaVehiculo->id_usuario_carga = $Session::get('datos-loggeo')->cod_usuario; 
            $visitaVehiculo->estado = 1;
            $visitaVehiculo->save();
            return redirect()->route('listadosVehiculos')->with('success','Se ha generado el ingreso del vehiculo');
        }catch(RequestException $e){
            return back()->with('error','No se ha generado el ingreso del vehiculo');
        }

    }


    public function doRecepcion(Request $request){
       /* echo '<pre>';
        print_r($request->all());*/
        try{
            DB::table('visitas_vehiculos')
                ->where('id',$request->input('id'))
                ->update([
                        'id_mecanico' =>  $request->input('mecanico'),
                        'fecha_asignacion_mecanico' =>  date('Y-m-d H:m:s'),
                        'observacion_recepcion' =>  $request->input('observacion_recepcion'),
                        'estado' =>  2
                        ]);

            foreach($request->input('datos') as $datos){
                $visitaVehiculo = new VisitaAccesorio;
                $visitaVehiculo->id_visita = $request->input('id'); 
                $visitaVehiculo->id_accesorio = $datos['id_accesorio']; 
                $visitaVehiculo->observacion = $datos['observacion'];
                $visitaVehiculo->activo = true;
                $visitaVehiculo->save();
            }
            return redirect()->route('listadosVehiculos')->with('success','Se ha ajustado el ingreso del vehiculo');
        }catch(RequestException $e){
            return back()->with('error','No se ha generado el ajuste del vehiculo');
        }

    }

    public function doMecanico(Request $request){
        try{
            DB::table('visitas_vehiculos')
                ->where('id',$request->input('id'))
                ->update([
                        'id_mecanico_carga' =>  $request->input('mecanico'),
                        'fecha_carga_mecanico' =>  date('Y-m-d H:m:s'),
                        'estado' =>  3
                        ]);

            if($request->input('base') != ""){
                foreach($request->input('base') as $datos){
                    $visitaVehiculo = new VisitaRepuesto;
                    $visitaVehiculo->id_visita = $request->input('id'); 
                    $visitaVehiculo->id_repuesto = $datos['id_repuesto']; 
                    $visitaVehiculo->cantidad = $datos['cantiddad'];
                    $visitaVehiculo->activo = true;
                    $visitaVehiculo->save();
                }
            } 
            
            if($request->input('datos') != ""){
                foreach($request->input('datos') as $datos){
                    $visitaVehiculo = new VisitaDanho;
                    $visitaVehiculo->id_visita = $request->input('id'); 
                    $visitaVehiculo->denominacion = $datos['danho'];
                    $visitaVehiculo->activo = true;
                    $visitaVehiculo->save();
                }
            }
            return redirect()->route('listadosVehiculos')->with('success','Se ha ajustado el ingreso del vehiculo');
        }catch(RequestException $e){
            return back()->with('error','No se ha generado el ajuste del vehiculo');
        }
    }

}
