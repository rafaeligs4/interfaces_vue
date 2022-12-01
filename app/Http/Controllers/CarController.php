<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function create(Request $request){
        
        $namefoto1="";
        $namefoto2="";
        $namefoto3="";
        $namefoto4="";
        if($request->foto1){
      
            $strpos= strpos($request->foto1,';');
            $sub= substr($request->foto1,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto1=Str::uuid().".".$ex;
            $img = Image::make($request->foto1)->resize(800,800); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto1);
            
          }
          if($request->foto2){
    
            $strpos= strpos($request->foto2,';');
            $sub= substr($request->foto2,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto2=Str::uuid().".".$ex;
            $img = Image::make($request->foto2)->resize(800,800); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto2);
            
          }
          if($request->foto3){
    
            $strpos= strpos($request->foto3,';');
            $sub= substr($request->foto3,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto3=Str::uuid().".".$ex;
            $img = Image::make($request->foto3)->resize(800,800); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto3);
            
          }
          if($request->foto4){
    
            $strpos= strpos($request->foto4,';');
            $sub= substr($request->foto4,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto4=Str::uuid().".".$ex;
            $img = Image::make($request->foto4)->resize(200,200); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto4); 
          }
        car::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'color' => $request->color,
            'placa' => $request->placa, 
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'foto1'  => $namefoto1,
            'foto2'  => $namefoto2,
            'foto3'  => $namefoto3,
            'foto4'  => $namefoto4, 
        ]);
    }
    public function getCars(){
        $cars = car::all();
        return response()->json(['carros' => $cars],200); 
    }
    public function view_car($id){
        $car = car::find($id);
        return response()->json([
          'car'=>$car,200
        ]);
      }
    public function edit(Request $request, $id){
   //     return response()->json(['carros' => "Listo"]); 
        $namefoto1="";
        $namefoto2="";
        $namefoto3=""; 
        $namefoto4="";
        $car = car::find($id);


        $validate=Validator::make($request->all(),
        [
          'marca'=>['required','min:6','max:30'],
          'modelo'=>['required','min:4','max:30'], 
          'placa'=>['required','min:6','max:10'],
           'color'=>['required','min:4','max:10'],
           'estado'=>['required'],
           'tipo'=>['required']
        ]   
      );
      if ($validate->fails()) {
        return response()->json(['error'=>$validate->errors()],422);                  
      }
        if( $request->foto1 != $car->foto1 ) {
      
            $strpos= strpos($request->foto1,';');
            $sub= substr($request->foto1,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto1=Str::uuid().".".$ex;
            $img = Image::make($request->foto1)->resize(600,600); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto1);
            $car->foto1 = $namefoto1;
          
          }
          if($request->foto2  != $car->foto2){
    
            $strpos= strpos($request->foto2,';');
            $sub= substr($request->foto2,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto2=Str::uuid().".".$ex;
            $img = Image::make($request->foto2)->resize(600,600); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto2);
            $car->foto2 = $namefoto2;
          
            
          }
          if($request->foto3  != $car->foto3){
    
            $strpos= strpos($request->foto3,';');
            $sub= substr($request->foto3,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto3=Str::uuid().".".$ex;
            $img = Image::make($request->foto3)->resize(600,600); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto3);
            $car->foto3 = $namefoto3;
      
            
          }
          if($request->foto4  != $car->foto4){
    
            $strpos= strpos($request->foto4,';');
            $sub= substr($request->foto4,0,$strpos);
            $ex = explode('/',$sub)[1];
            $namefoto4=Str::uuid().".".$ex;
            $img = Image::make($request->foto4)->resize(600,600); 
            $upload_path = public_path()."/photo/" ;
            $img->save($upload_path.$namefoto4); 
            $car->foto4 = $namefoto4; 
          }
    

          $car->marca = $request->marca ?? $car->marca ?? null; 
          $car->modelo = $request->modelo ?? $car->marca ?? null;
          $car->color = $request->color ?? $car->color ?? null;
          $car->placa =   $request->placa ??  $car->placa ?? null;
          $car->tipo =  $request->tipo ?? $car->tipo ?? null;
         
          $car->save();
        }
    public function delete($id){
        $car = car::findOrFail($id);
        $imagen_f1=public_path()."/photo/".  $car->foto1;
        $imagen_f2=public_path()."/photo/".  $car->foto2;
        $imagen_f3=public_path()."/photo/".  $car->foto3;
        $imagen_f4=public_path()."/photo/".  $car->foto4;
        if(file_exists($imagen_f1)){
          @unlink($imagen_f1);
        } 
        if(file_exists($imagen_f2)){
            @unlink($imagen_f2);
        }
        if(file_exists($imagen_f3)){
            @unlink($imagen_f3);
        }
        if(file_exists($imagen_f4)){
            @unlink($imagen_f4);
        }
        $car->delete();  
    }
    public function changeState(Request $request, $id){
   //   return response()->json(['message'=> $request->estado]); 
        $car = car::find($id);
        $car->estado = $request->estado;
       $car->save();
    } 
    public function changePosition(Request $request, $id){
      $car =car::find($id);
      $car->foto1 = $request->foto1;
      $car->foto2 = $request->foto2;
      $car->foto3 = $request->foto3;
      $car->foto4 = $request->foto4;
      $car->save(); 
      return response()->json(['message'=>'hola']); 
    }
} 

