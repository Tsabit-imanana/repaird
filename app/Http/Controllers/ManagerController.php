<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Orders;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class ManagerController extends Controller

{
    // public function show(){
    //     $data = Orders::with(['device', 'device.customer'])->get();

    // return response()->json($data);
    // }

    public function showByStatus(Request $request){
        $status = $request->status;

    $orders = Orders::with(['device', 'device.customer'])
        ->where('status', $status)
        ->get();

    return response()->json(['orders' => $orders]);

    }
    

    public function show()
{

    $ordersQuery = Orders::with(['device', 'device.customer']);

    $orders = $ordersQuery->get();

    $doneTotal = $orders->where('status', 'done')->sum('price');
    $queueTotal = $orders->where('status', 'queue')->sum('price');
    $repairedTotal = $orders->where('status', 'repaired')->sum('price');
    $onServiceTotal = $orders->where('status', 'on_service')->sum('price');

    $totalOrders = $orders->count(); // Total jumlah orders

    $totalDoneOrders = $orders->where('status', 'done')->count();
    $totalQueueOrders = $orders->where('status', 'queue')->count();
    $totalRepairedOrders = $orders->where('status', 'repaired')->count();
    $totalOnServiceOrders = $orders->where('status', 'on_service')->count();

    $totalOrdersPrice = $doneTotal + $queueTotal + $repairedTotal + $onServiceTotal;

    return response()->json([

        'orders' => [
            'ordersTotal' =>$totalOrders,
            'totalPrice' => $totalOrdersPrice
        ],

        'done' =>[
            'doneTotal' => $doneTotal,
            'totalDoneOrders' => $totalDoneOrders,
        ],
        'quwuw' =>[
            'totalQueueOrders' => $totalQueueOrders,
        'queueTotal' => $queueTotal,
        ],
        'repaired' =>[
            'repairedTotal' => $repairedTotal,
        'totalRepairedOrders' => $totalRepairedOrders,
        ],
        'onService' =>[
            'onServiceTotal' => $onServiceTotal,
            'totalOnServiceOrders' => $totalOnServiceOrders
        ],   

        $orders
       
    ]);   
}

public function getOrderById(Request $request, $orderId)
{
    $order = Orders::with(['device', 'device.customer'])->find($orderId);

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    return response()->json(['order' => $order]);
}


}
