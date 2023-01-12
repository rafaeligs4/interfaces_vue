<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use App\Models\car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
    public function create_rent(Request $request){

        $validate=Validator::make($request->all(),
        [
            'car'=>['required'],
          'client'=>['required'], 
          'precio'=>['required','min:6','max:10','numeric'],
           'fecha_ini'=>['required','before_or_equal:'.$request->fecha_fin],
           'fecha_fin'=>['required','after_or_equal:'.$request->fecha_ini],
          
        ]   
      );
      if ($validate->fails()) {
        return response()->json(['error'=>$validate->errors()],422);                  
      }
        $vdt=Carbon::create($request->fecha_ini);
        $vfn=Carbon::create($request->fecha_fin);
        $valor=$vfn->diffInDays($vdt);
       
        Rent::create([
        'car_complete'=>$request->car,
        'user_complete'=>$request->client,
        'user_id'=>$request->id_user,
        'car_id'=>$request->id_car,
        'price'=>$request->precio,
        'fecha_inic'=>$request->fecha_ini,
         'fecha_final'=>$request->fecha_fin,
         'days'=>$valor,
         'estado'=>"cancelado"
        ]);
        return response()->json(['message'=> $valor]);  
        
    }
    public function getAllc(){
        $rents = Rent::all();
        return response()->json(['rents'=> $rents]);  
    }
    public function dataInvoice($id){
        $usr=User::find($id);
        $rents=$usr->rents()->get();
        $cars = [];
        foreach($rents as $rent){
           
           $cars[]=$rent->cars()->get();
        }
        return response()->json(['user'=> $usr,
                                'cars'=>$cars,
                                'rents'=>$rents
    ]);  
    } 
    public function getRent($id){
        $rent=Rent::find($id);
        return response()->json(['rent'=> $rent]);  
    
    }
    public function edit_rent($id,Request $request){
        $validate=Validator::make($request->all(),
        [
            'car'=>['required'],
          'client'=>['required'], 
          'precio'=>['required','min:6','max:10','numeric'],
           'fecha_ini'=>['required','before_or_equal:'.$request->fecha_fin],
           'fecha_fin'=>['required','after_or_equal:'.$request->fecha_ini],
          
        ]   
      );
      if ($validate->fails()) {
        return response()->json(['error'=>$validate->errors()],422);                  
      }

        $rent=Rent::find($id);
        $rent->car_complete=$request->car;
        $rent->user_complete=$request->client;
        $rent->user_id=$request->id_user;
        $rent->car_id=$request->id_car;
        $rent->price=$request->precio;
        $rent->fecha_inic=$request->fecha_ini;
        $rent->fecha_final=$request->fecha_fin;
        $rent->save();
        return response()->json(['message'=> $rent]);  
    }
}
  