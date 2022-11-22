<?php

namespace App\Http\Controllers;

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
  
    public function update(Request $request){
      return response()->json(['message' => $request->name]);
    }
}
 