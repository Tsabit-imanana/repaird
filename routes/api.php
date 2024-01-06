<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CsController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RepairController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//cari order
Route::post('/cekorder',[GuestController::class , 'index']);
Route::get('/',[OrdersController::class , 'test']);


//SERVICE

// mark as on service (ambil order)
Route::put('/orders/{orderId}/mark-as-on-service', [RepairController::class,'markAsOnService']);
// mark as repaired
Route::put('/orders/{orderId}/mark-as-repaired', [RepairController::class,'markAsRepaired']);


//CS

//mark as done
Route::put('/orders/{orderId}/mark-as-done', [CsController::class,'markAsDone']);
//create order
Route::post('/order',[CsController::class , 'create']);
//List done order
Route::get('/orders/done',[CsController::class,'ordersDone']);



//MANAGER
Route::get('/orders',[ManagerController::class,'show']);
Route::get('/order/{orders_id}',[ManagerController::class,'getOrderById']);
Route::post('/orders/status',[ManagerController::class,'showByStatus']);

//ADMIN
Route::get('/users',[AdminController::class,'showuser']);

