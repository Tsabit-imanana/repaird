<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreordersRequest;
use App\Http\Requests\UpdateordersRequest;
use App\Models\device;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Orders::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'product' => 'required',
            'type' => 'required',
            'damage' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);

        customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'adress' => $request->adress,
        ]);
        $cust_id = customer::latest()->first();
        $cust_id = $cust_id->cust_id;

        device::create([
            'cust_id' => $cust_id,
            'product' => $request->product,
            'type' => $request->type,
            'damage' => $request->damage,
        ]);

        $device_id = device::latest()->first();
        $device_id = $device_id->device_id;

        orders::create([
            'cust_id' => $cust_id,
            'device_id' => $device_id,
            'status' => $request->status,

        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreordersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateordersRequest $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orders $orders)
    {
        //
    }
}
