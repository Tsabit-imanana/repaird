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

Route::post('/',[OrdersController::class , 'index']);
Route::post('/order',[OrdersController::class , 'create']);

//mark as done
Route::put('/orders/{orderId}/mark-as-done', [OrdersController::class,'markAsDone']);
// mark as on service
Route::put('/orders/{orderId}/mark-as-on-service', [OrdersController::class,'markAsOnService']);
// mark as repaired
Route::put('/orders/{orderId}/mark-as-repaired', 'OrdersController@markAsRepaired');
