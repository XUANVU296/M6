<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_detail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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
    public function checkout(Request $request)
    {
        $user = Auth::guard('customers')->user();
       if($user) {
            $customer_id = $user->id;
       } else {
            $customer = new Customer();
            $customer->name = $request->c_name;
            $customer->phone = $request->c_phone;
            $customer->email = $request->c_email;
            $customer->save();
            $customer_id = $customer->id;
       }

       $total_amount = 0;
       foreach ($request->cart as $key => $cart) {
            $price = Product::find($cart['product_id'])->price;
            $total_amount += $price * $cart['quantity'];
        }
        $order = new Order();
        $order->customer_id = $customer_id;
        $order->date = date("Y-m-d");
        $order->total_amount = $total_amount;
        $order->save();
        foreach ($request->cart as $key => $cart) {
            $order_detail = new Order_detail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $cart['product_id'];
            $price = Product::find($cart['product_id'])->value("price");
            $order_detail->price = $price;
            $order_detail->quantity = $cart['quantity'];
            $order_detail->save();
        }
        // Mail::to($user->email)->send(new OrderConfirmation($order));
        return response()->json(['message' => 'Đơn hàng đã được xử lý và đã nhận được xác nhận qua email.']);
    }
}
