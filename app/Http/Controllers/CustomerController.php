<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|string|unique:customers,customer_id',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|max:50',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        return Customer::create($request->all());
    }

    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return $customer;
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return response()->json(['message' => 'Customer deleted']);
    }
}
