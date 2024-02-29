<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index(Request $request)
{
    $query = Customer::orderBy('id', 'DESC');
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
public function create()
{
    return view('admin.customers.create');
}
public function store(StoreCustomerRequest $request)
{
    try {
        $item = new Customer();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->save();
        Log::info('Customer stored successfully. ID: ' . $item->id);
        return redirect()->route('customers.index')->with('success', __('sys.store_item_success'))->with('customers');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->route('customers.index')->with('error', __('sys.store_item_error'));
    }
}
public function edit($id)
    {
        try {
            $item = Customer::findOrFail($id);
            // $this->authorize('update',  $item);
            $params = [
                'item' => $item
            ];
            return view("admin.customers.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(UpdateCustomerRequest $request, $id)
    {
        try {
            $item = Customer::findOrFail($id);
            $item->name = $request->name;
            $item->email = $request->email;
            $item->phone = $request->phone;
            $item->save();
            Log::info('Customer updated', ['id' => $item->id]);
            return redirect()->route('customers.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Customer::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            Log::info('Customer message', ['context' => 'value']);
            return redirect()->route('customers.index')->with('success', __('sys.destroy_item_success1'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('customers.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
