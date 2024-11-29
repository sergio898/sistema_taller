<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaAccesorio extends Model
{
    use HasFactory;
    protected $table = 'accesorio_visita';
    public $timestamps = false;
}
