<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  
    public function view($id){
      $user = User::find($id);
      return response()->json([
        'user'=>$user,200]); 
    }
    public function update(Request $request, $id){  
      $user = User::find($id);
    
     $date_today=Carbon::now();      
      $date=Carbon::now();
      $validate=Validator::make($request->all(),
      [
        'name'=>['required','min:4','max:30'],
        'apellido'=>['required','min:4','max:30'], 
        'cedula'=>['required','unique:users,cedula,'.$user->id,'min:4','max:10'],
         'no_licencia'=>['required','unique:users,no_licencia,'.$user->id,'min:4','max:10'],
         'fecha_nac'=>['required','before_or_equal:'.$date_today->subYears(18)->format('y-m-d')],
         'fecha_venc'=>['required','after_or_equal:'.$date->format('y-m-d')]
      ]   
    );
     
    if ($validate->fails()) {
      return response()->json(['error'=>$validate->errors()],422);                  
    }

   
      $user->name= $request->name ?? $user->name ?? null; 
      $user->apellido = $request->apellido ?? $user->apellido  ?? null;
      $user->cedula = $request->cedula ?? $user->cedula ?? null;
      $user->no_licencia  =$request->no_licencia ??  $user->no_licencia ?? null;
      $user->fecha_nac = $request->fecha_nac ??  $user->fecha_nac ?? null;
      $user->fecha_venc = $request->fecha_venc ?? $user->fecha_venc ?? null;

      if($user->foto_perfil != $request->foto_perfil){
    
         $strpos= strpos($request->foto_perfil,';');
         $sub= substr($request->foto_perfil,0,$strpos);
         $ex = explode('/',$sub)[1];
         $name=Str::uuid().".".$ex;
         $img = Image::make($request->foto_perfil)->resize(200,200);  
         $upload_path = public_path()."/photo/" ;
         $img->save($upload_path.$name);
         $user->foto_perfil = $name;
       }
       if($user->foto_licencia != $request->foto_lic ){
       
        $strpos= strpos($request->foto_lic,';');
        $sub= substr($request->foto_lic,0,$strpos); 
        $ex = explode('/',$sub)[1];
        $name=Str::uuid().".".$ex;
        $img = Image::make($request->foto_lic)->resize(200,200); 
        $upload_path = public_path()."/photo/" ;
        $img->save($upload_path.$name);
        $user->foto_licencia = $name ?? $user->foto_licencia ?? null; 
      }
        $user->save();    

      }
   public function get_users(){
        $users = User::all();
        return response()->json([
          'users' =>$users
        ],200);
   }
   public function delete($id){
      $user = User::findOrFail($id);
      $imagen_P=public_path()."/photo/".$user->foto_perfil;
      $imagen_L=public_path()."/photo/".$user->foto_licencia;
      if(file_exists($imagen_P)){
        @unlink($imagen_P);
      }
      if(file_exists($imagen_L)){
        @unlink($imagen_L);
      }
      $user->delete();  
   }   
      
} 