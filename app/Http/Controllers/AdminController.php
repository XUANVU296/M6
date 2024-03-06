<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $product = Product::all()->count();
        $category = Category::all()->count();
        $group = Group::all();
        $user = User::all()->count();
        $order = Order::all()->count();

        return view('admin.index', compact('product', 'category', 'group', 'user' , 'order'));
    }
}
