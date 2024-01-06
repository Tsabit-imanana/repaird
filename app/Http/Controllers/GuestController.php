<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use App\Models\Orders;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required'
        ]);

        $customer = Customer::where('phone', $request->phone)->first();
        $customerIds = Customer::where('phone', $request->phone)->pluck('cust_id');
        $devices = Device::whereIn('cust_id', $customerIds)->get();
        $orders = Orders::whereIn('cust_id', $customerIds)->get();

        $groupedDevices = [];
        foreach ($devices as $device) {
            $groupId = $device->device_id;
            $groupedDevices[$groupId][] = $device;
        }

        $ordersWithDevices = [];
        foreach ($orders as $order) {
            $orderId = $order->device_id;
            $orderArray = $order->toArray();

            if (isset($groupedDevices[$orderId])) {
                $orderArray['devices'] = $groupedDevices[$orderId];
            } else {
                $orderArray['devices'] = [];
            }

            $ordersWithDevices[] = $orderArray;
        }

        return response()->json([
            'customer' => $customer,
            'orders' => $ordersWithDevices
        ]);
    }
}
