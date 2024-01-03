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

        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $customer = Customer::latest()->first();
        $cust_id = $customer->cust_id;

        $device = Device::create([
            'cust_id' => $cust_id,
            'product' => $request->product,
            'type' => $request->type,
            'damage' => $request->damage,
        ]);

        $device = $device::latest()->first();
        $device_id = $device->device_id;

        
        $mytime = Carbon::now();

        Orders::create([
            'cust_id' => $cust_id,
            'device_id' => $device_id,
            'condition' => $request->condition,
            'status' => 'queue',
            'price' => $request->price,
            'date' => $mytime
        ]);

        return response()->json(['ok']);
    }

    public function markAsDone(Request $request, $orderId)
    {
        $order = Orders::where('orders_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->status = 'done';
        $order->save();

        return response()->json(['message' => 'Order status updated to "done"']);
    }

    public function markAsOnService(Request $request, $orderId)
    {
        $order = Orders::where('orders_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Jika status sudah 'on service', kembalikan respons khusus
        if ($order->status === 'on service') {
            return response()->json([
                'message' => 'Order status is already "on service"',
            ]);
        }

        // Ubah status menjadi 'on service' jika belum
        $order->status = 'on service';
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
        if ($order->status === 'Repaired') {
            return response()->json([
                'message' => 'Order status is already "Repaird"',
            ]);
        }

        // Ubah status menjadi 'on service' jika belum
        $order->status = 'Repaired';
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
