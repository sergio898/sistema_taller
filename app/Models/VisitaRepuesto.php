<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaRepuesto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'repuestos_visitas';
}
