<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $query = Order::orderBy('id', 'DESC');
    if ($request->filled('search_name') || $request->filled('search_email') || $request->filled('search_phone')) {
        $query->where(function($query) use ($request) {
            if ($request->filled('search_name')) {
                $query->where('name', 'like', "%{$request->input('search_name')}%");
            }
            if ($request->filled('search_email')) {
                $query->where('email', 'like', "%{$request->input('search_email')}%");
            }
            if ($request->filled('search_phone')) {
                $query->where('phone', 'like', "%{$request->input('search_phone')}%");
            }
        });
    }
    $customers = $query->paginate(3);
    return view('admin.customers.index', compact('customers'));
}
}
