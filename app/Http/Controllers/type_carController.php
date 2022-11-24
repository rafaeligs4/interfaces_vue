<?php

namespace App\Http\Controllers;

use App\Models\type_car;
use Illuminate\Http\Request;

class type_carController extends Controller
{

   public function create(Request $request){
    
  
   $estado=false;
   if($request->estado=="true"){
     $estado=true;
   }
 //  return response()->json(['message' => $estado]);
     type_car::create([
        'nombre_tipo_vehiculo' => $request->nombre_tipo_vehiculo,
        'estado' => $estado

      ]); 
   }
   public function get_type_cars(){
        $types= type_car::where('estado',1)->get();

        return response()->json([
        'tipos' => $types
    ],200);
   }
}
