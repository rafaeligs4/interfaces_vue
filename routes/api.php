<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\type_carController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/edit/{id}',[UserController::class,'view']); 
Route::get('/get_all',[UserController::class,'get_users']);
Route::get('/delete_user/{id}',[UserController::class,'delete']);
Route::get('get_all_cars',[CarController::class,'getCars']);  
Route::get('get_car/{id}',[CarController::class,'view_car']);  
Route::get('/get_all_types_cars',[type_carController::class,'get_type_cars']);
Route::post('/upload/{id}',[UserController::class,'update']); 
Route::post('/create_car',[CarController::class,'create']);
Route::post('/edit_car/{id}',[CarController::class,'edit']);
Route::post('/delete_car/{id}',[CarController::class,'delete']);   
Route::post('/type/create',[type_carController::class,'create']); 
