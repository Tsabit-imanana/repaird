<?php

use App\Http\Controllers\OrdersController;
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
Route::post('/',[OrdersController::class , 'index']);


//SERVICE

// mark as on service (ambil order)
Route::put('/orders/{orderId}/mark-as-on-service', [OrdersController::class,'markAsOnService']);
// mark as repaired
Route::put('/orders/{orderId}/mark-as-repaired', [OrdersController::class,'markAsRepaired']);


//CS

//mark as done
Route::put('/orders/{orderId}/mark-as-done', [OrdersController::class,'markAsDone']);
//create order
Route::post('/order',[OrdersController::class , 'create']);