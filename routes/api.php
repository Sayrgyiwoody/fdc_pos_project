<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

//Get data
Route::get('product/list',[RouteController::class,'productList']);
Route::get('product/list/{id}',[RouteController::class,'productDetail']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('category/list/{id}',[RouteController::class,'categoryDetail']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('contact/list',[RouteController::class,'contactList']);

//Create Data
Route::post('category/create',[RouteController::class,'categoryCreate']);
Route::post('product/create',[RouteController::class,'productCreate']);

//Delete Data
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);
Route::post('product/delete',[RouteController::class,'productDelete']);

//Update Data
Route::post('category/update',[RouteController::class,'categoryUpdate']);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|  http://127.0.0.1:8000/api/product/list (GET)
|  http://127.0.0.1:8000/api/category/list (GET)
|  http://127.0.0.1:8000/api/user/list (GET)
|  http://127.0.0.1:8000/api/order/list (GET)
|  http://127.0.0.1:8000/api/contact/list (GET)

|  http://127.0.0.1:8000/api/category/create (POST) key=>name
|  http://127.0.0.1:8000/api/product/create (POST) key=>category_id,name,price,description,waiting_time,productImage

|  http://127.0.0.1:8000/api/category/delete/{id} (GET)
|  http://127.0.0.1:8000/api/product/delete (POST) key=> id

|  http://127.0.0.1:8000/api/category/update (POST) key=> id,name


|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
