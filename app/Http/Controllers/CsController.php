<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Orders;
use App\Models\Customer;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class CsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'product' => 'required',
            'type' => 'required',
            'damage' => 'required',
            'condition' => 'required',
            'price' => 'required',
        ]);
    
        // Membuat Customer baru
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        // Membuat Device untuk Customer yang baru dibuat
        $device = $customer->devices()->create([
            'product' => $request->product,
            'type' => $request->type,
            'damage' => $request->damage,
        ]);
    
        // Membuat Order terkait dengan Device yang baru dibuat
        $mytime = Carbon::now();
        Orders::create([
            'cust_id' => $customer->cust_id,
            'device_id' => $device->device_id,
            'condition' => $request->condition,
            'status' => 'queue',
            'price' => $request->price,
            'date' => $mytime,
        ]);
    
        return response()->json(['message' => 'Data has been created successfully']);
    }


    public function markAsDone(Request $request, $orderId)
{
    $order = Orders::where('orders_id', $orderId)->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    if ($order->status !== 'repaired') {
        return response()->json(['message' => 'Order has not been repaired yet'], 200);
    }

    $order->status = 'done';
    $order->save();

    return response()->json(['message' => 'Order status updated to "done"'], 200);
    }

    public function ordersDone()
    {
    $ordersDone = Orders::with(['device.customer'])
                    ->where('status', 'done')
                    ->get();

    return response()->json(['ordersDone' => $ordersDone]);
}
}
