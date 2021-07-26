<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
    protected $fillable = ['nombre_completo','cedula','edad','facultad_id','correo'];
}