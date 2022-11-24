<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view($id){
      $user = User::find($id);
      return response()->json([
        'user'=>$user,200
      ]);
    }
    public function update(Request $request, $id){
      $user = User::find($id);

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
 