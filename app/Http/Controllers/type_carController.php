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
   public function get_type($id){
     $tcar= type_car::find($id);
     return response()->json(['tipo'=>$tcar]); 
   
    }
  
    public function get_type_cars(){
        $types= type_car::where('estado',1)->get();

        return response()->json([
        'tipos' => $types
    ],200);
   }


   public function get_all_type_cars(){
    $types= type_car::all(); 
  
    return response()->json([
    'tipos' => $types 
],200);
   }
   public function upload_type($id,Request $request){
    $tcar= type_car::find($id); 
    $tcar->nombre_tipo_vehiculo = $request->nombre_tipo_vehiculo;
    $tcar->save();
    return response()->json(['message'=>'listo']);

   }
   public function delete($id){
    $tcar = type_car::findOrFail($id);
    $tcar->delete();    
    return response()->json(['message'=>'listo']); 
   }

   public function status($id,Request $request){

    $estado=false;
    if($request->estado=="true"){
      $estado=true;
    }
    $tcar = type_car::find($id);
    $tcar->estado = $estado; 
    $tcar->save();
    return response()->json(['message'=>'listo']); 
} 
   
}
