<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        $query = Order::orderBy('id', 'DESC');
    
        if ($request->filled('search_name') || $request->filled('search_phone') || $request->filled('search_status')) {
            $query->whereHas('customers', function ($query) use ($request) {
                if ($request->filled('search_name')) {
                    $query->where('name', 'like', "%{$request->input('search_name')}%");
                }
            });
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
    
            // Chuyển ngày tháng sang định dạng Y-m-d
            $startDateFormatted = Carbon::parse($startDate)->startOfDay();
            $endDateFormatted = Carbon::parse($endDate)->endOfDay();
    
            // Tìm kiếm các đơn hàng trong khoảng thời gian từ start_date đến end_date
            $query->whereBetween('date', [$startDateFormatted, $endDateFormatted]);
        }
        if ($request->filled('search_total')) {
            $totalRange = explode('-', $request->input('search_total'));
            if (count($totalRange) == 2) {
                $minTotal = $totalRange[0];
                $maxTotal = $totalRange[1];
                $query->whereBetween('total_amount', [$minTotal, $maxTotal]);
            } elseif ($request->input('search_total') == '101') {
                $query->where('total_amount', '>', 100);
            }
        }
        $orders = $query->paginate(3);
        return view('admin.orders.index', compact('orders','customers'));
    }
public function create()
{
    $customers = Customer::all();
    $products = Product::all();
    return view('admin.orders.create', compact('customers','products'));
}
public function store(StoreOrderRequest $request)
{
    try {
        $item = new Order();
        $item->customer_id = $request->customer_id;
        $item->date = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $item->total_amount = $request->total_amount;
        $item->quantity = $request->quantity;
        $item->product_id = $request->product_id;
        $item->order_status = $request->order_status;
        $item->save();
        return redirect()->route('orders.index')->with('successMessage','Thêm đơn hàng thành công');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->route('orders.index')->with('errorMessage','Thêm thất bại');
    }
}
public function destroy($id)
    {
        try {
            $item = Order::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            return redirect()->route('orders.index')->with('successMessage','Xóa đơn hàng thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('orders.index')->with('errorMessage','Xóa thất bại');
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('orders.index')->with('errorMessage','Xóa không thành công');
        }
    }
    public function show($id) {
        $item = Order::with('products')->find($id);
        return view('admin.orders.show', compact('item'));
    }
    public function delete($id) {
        $item = Order::findOrFail($id);
        $item->delete();
        return redirect()->route('orders.index')->with('successMessage','Xóa đơn hàng thành công');
    }
}