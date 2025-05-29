<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        return OrderItem::with(['order', 'product'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:order_items,id',
            'order_id' => 'required|exists:orders,order_id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        return OrderItem::create($request->all());
    }

    public function show($id)
    {
        return OrderItem::with(['order', 'product'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = OrderItem::findOrFail($id);
        $item->update($request->all());

        return $item;
    }

    public function destroy($id)
    {
        OrderItem::destroy($id);
        return response()->json(['message' => 'Order item deleted']);
    }
}
