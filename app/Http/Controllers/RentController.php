<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function create_rent(Request $request){
        Rent::create([
            'car_complete'=>$request->car,
        'user_complete'=>$request->client,
        'user_id'=>$request->id_user,
        'car_id'=>$request->id_car,
        'price'=>$request->precio,
        'fecha_inic'=>$request->fecha_ini,
         'fecha_final'=>$request->fecha_fin
        ]);
        return response()->json(['message'=> $request->all()]);  
    }
}
 