<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->date = $request->date;
        $order->total_amount = $request->total_amount;
        $order->quantity = $request->quantity;
        $order->order_status = $request->order_status;
        $order->product_id = $request->product_id;
        $order->save();
        return response()->json([
            'message' =>'ok',
            'order' =>$order
        ], 201);
    }


}

