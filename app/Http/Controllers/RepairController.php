<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Orders;
use App\Models\Customer;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class RepairController extends Controller
{
    public function markAsOnService(Request $request, $orderId)
    {
        $order = Orders::where('orders_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Jika status sudah 'on service', kembalikan respons khusus
        if ($order->status === 'on_service') {
            return response()->json([
                'message' => 'Order status is already "on service"',
            ]);
        }

        // Ubah status menjadi 'on service' jika belum
        $order->status = 'on_service';
        $order->save();
        $order = Orders::where('orders_id', $orderId)->first();

        return response()->json([
            'message' => 'Order status updated to "on service"',
            'data' => [
                'order' => $order,
                'customer' => Customer::where('cust_id',$order->cust_id),
                'device' => Device::where('cust_id', $order->cust_id)->first(),
            ]
        ]);
    }

    
    public function markAsRepaired(Request $request, $orderId)
    {
        $order = Orders::where('orders_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Jika status sudah 'on service', kembalikan respons khusus
        if ($order->status === 'repaired') {
            return response()->json([
                'message' => 'Order status is already "Repaird"',
            ]);
        }

        // Ubah status menjadi 'on service' jika belum
        $order->status = 'repaired';
        $order->save();
        $order = Orders::where('orders_id', $orderId)->first();

        return response()->json([
            'message' => 'Order status updated to "Repaired"',
            'data' => [
                'order' => $order,
                'customer' => Customer::where('cust_id',$order->cust_id),
                'device' => Device::where('cust_id', $order->cust_id)->first(),
            ]
        ]);
    }
}
