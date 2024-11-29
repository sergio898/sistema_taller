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

class MarcaController extends Controller
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

}
