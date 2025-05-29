<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('orderItems')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string|unique:orders,order_id',
            'customer_id' => 'required|exists:customers,customer_id',
            'order_date' => 'required|date',
            'total_amount' => 'required|integer',
            'status' => 'required|string',
        ]);

        return Order::create($request->all());
    }

    public function show($id)
    {
        return Order::with('orderItems')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return $order;
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return response()->json(['message' => 'Order deleted']);
    }
}
