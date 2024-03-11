<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'date' => 'required|date',
            'total_amount' => 'required|numeric',
            'quantity' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        // Create a new order
        $order = Order::create([
            'customer_id' => $validatedData['customer_id'],
            'product_id' => $validatedData['product_id'],
            'date' => $validatedData['date'],
            'total_amount' => $validatedData['total_amount'],
            'quantity' => $validatedData['quantity'],
            // Add other fields as needed
        ]);

        // Return a response
        return response()->json(['message' => 'Đặt hàng thành công', 'order' => $order], 200);
    }
}
