<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $fillable =[
        'car_complete',
        'user_complete',
        'user_id',
        'car_id',
        'price',
        'fecha_inic',
         'fecha_final',
         'estado',
         'days'
    ];

public function cars(){
    return $this->belongsTo(car::class,'car_id');
}
}
