<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Orders;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class OrdersController extends Controller
{
    public function test(){

            $data = Orders::all();

        return response()->json([
            $data
        ]);
    }

    






    public function store(StoreOrdersRequest $request)
    {
        //
    }

    public function show(Orders $orders)
    {
        //
    }

    public function edit(Orders $orders)
    {
        //
    }

    public function update(UpdateOrdersRequest $request, Orders $orders)
    {
        //
    }

    public function destroy(Orders $orders)
    {
        //
    }
}
