<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_car extends Model
{
    use HasFactory;

    protected $fillable =[
        'nombre_tipo_vehiculo',
        'estado'
    ] ;
}
