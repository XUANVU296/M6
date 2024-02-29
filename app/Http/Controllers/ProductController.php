<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('viewAny', Category::class);
        $keyword = $request->input('keyword');
        $query = Product::orderBy('id', 'DESC')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name');

        if ($keyword) {
            $query = $query->where('products.name', 'like', "%$keyword%");
        }

        $products = $query->paginate(5);

        return view('admin.products.index', compact('products', 'keyword'));
    }
    public function create()
    {
        $categories = Category::get();

        // $this->authorize('create', Category::class);

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $item = new Product();
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->quantity = $request->quantity;
            $item->status = $request->status;
            $item->category_id  = $request->category_id;
            $fieldName = 'image';
            if ($request->hasFile($fieldName)) {
                $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $item->image = $path;
            }
            $item->save();
            Log::info('Product stored successfully. ID: ' . $item->id);
            return redirect()->route('products.index')->with('success', __('sys.store_item_success'))->with('products');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.store_item_error'));
        }
    }
    public function edit($id)
    {
        try {
            $item = Product::findOrFail($id);
            // $this->authorize('update',  $item);
            $categories = Category::all();

            $params = [
                'item' => $item,
                'categories' => $categories
            ];
            return view("admin.products.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $item = Product::findOrFail($id);
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->quantity = $request->quantity;
            $item->status = $request->status;
            $item->category_id  = $request->category_id;
            $fieldName = 'image';
            if ($request->hasFile($fieldName)) {
                $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $item->image = $path;
            }
            $item->save();
            Log::info('Product updated', ['id' => $item->id]);
            return redirect()->route('products.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Product::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            Log::info('Product message', ['context' => 'value']);
            return redirect()->route('products.index')->with('success', __('sys.destroy_item_success1'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', __('sys.destroy_item_error'));
        }
    }
    public function show($id)
    {
         try {
        $item = Product::findOrFail($id);
        $params = [
            'item' => $item
        ];
        return view("admin.products.show", $params);
    } catch (ModelNotFoundException $e) {
        Log::error($e->getMessage());
        return redirect()->route('products.index')->with('error', __('sys.item_not_found'));
    }
    }
}
