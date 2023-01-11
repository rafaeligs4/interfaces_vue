<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentController;
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

//Users
Route::get('/edit/{id}',[UserController::class,'view']); 
Route::get('/get_all',[UserController::class,'get_users']);
Route::post('/upload/{id}',[UserController::class,'update']); 
Route::get('/delete_user/{id}',[UserController::class,'delete']);
//Cars
Route::get('get_all_cars',[CarController::class,'getCars']);  
Route::get('get_car/{id}',[CarController::class,'view_car']);  
Route::post('/state/{id}',[CarController::class,'changeState']);
Route::post('/create_car',[CarController::class,'create']);
Route::post('/changeposition/{id}',[CarController::class,'changePosition']);
Route::post('/edit_car/{id}',[CarController::class,'edit']);
Route::post('/delete_car/{id}',[CarController::class,'delete']);   
//Type of cars
Route::get('/get_all_types_cars',[type_carController::class,'get_all_type_cars']); 
Route::get('/get_types_cars',[type_carController::class,'get_type_cars']);

Route::get('get_type/{id}',[type_carController::class,'get_type']);

Route::post('/type/update/{id}',[type_carController::class,'upload_type']);
Route::post('/type/delete/{id}',[type_carController::class,'delete']); 
Route::post('/type/create',[type_carController::class,'create']); 
Route::post('/type/state/{id}',[type_carController::class,'status']);  
//Rent

Route::get('/get_concat_cars',[CarController::class,'concatAllCars']); 
Route::get('/get_concat_clients',[UserController::class,'concatAllClients']); 

Route::get('/get_data_invoice/{id}',[RentController::class,'dataInvoice']);  
Route::get('/get_all_rents',[RentController::class,'getAllc']);  

Route::post('/create_rent/',[RentController::class,'create_rent']);  
