<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\User;
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
      $user->save();   
      
      // if($request->foto_perfil){
      //   $strpos= strpos($request->foto_perfil,';');
      //   $sub= substr($request->foto_perfil,0,$strpos);
      //   $ex = explode('/',$sub)[1];
      //   $name=time().".".$ex;
      //   $img = Image::make($request->foto_perfil)->resize(200,200); 
      //   $upload_path = public_path()."/upload/" ;
      //   $img->save($upload_path.$name);
       
      // }
    }
}
 