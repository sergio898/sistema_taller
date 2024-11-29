<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaVehiculo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'visitas_vehiculos';
    
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'id_modelo', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'id_seguro', 'id');
    }

}
