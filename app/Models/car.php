<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    use HasFactory;

    protected $fillable =[
        'marca',
        'modelo',
        'estado',
        'tipo',
        'color',
        'placa',
        'foto1',
        'foto2',
        'foto3',
        'foto4'
    ];
}
