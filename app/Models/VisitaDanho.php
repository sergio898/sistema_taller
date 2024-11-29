<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaDanho extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'danho_visitas';
}
