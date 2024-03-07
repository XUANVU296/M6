<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
    try {
        $this->authorize('viewAny', Product::class);
        $categories = Category::all();
        $keyword = $request->input('keyword');
        $status = $request->input('status');
        $category_id = $request->input('category_id');
        $price = $request->input('price');
        $priceValue = floatval($price);

        $query = Product::orderBy('id', 'DESC')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name');

        if ($keyword) {
            $query = $query->where('products.name', 'like', "%$keyword%");
        }
        if ($status) {
            $query = $query->where('products.status', 'like', "%$status%");
        }
        if ($category_id) {
            $query = $query->where('products.category_id', 'like', "%$category_id%");
        }

        if ($price) {
            $query = $query->where('products.price', '<=', $priceValue);
        }

        $products = $query->paginate(5);

        return view('admin.products.index', compact('products', 'keyword', 'status', 'category_id', 'price', 'categories'));
    } catch (\Exception $exception) {
        // Xử lý lỗi ở đây nếu cần
        // Ví dụ: Log lỗi, chuyển hướng người dùng, hiển thị thông báo lỗi, v.v.
        return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi khi hiển thị danh sách sản phẩm');
    }
}

    public function create()
{
    try {
        $categories = Category::get();
        $this->authorize('create', Product::class);
        return view('admin.products.create', compact('categories'));
    } catch (\Exception $exception) {
        // Xử lý lỗi ở đây nếu cần
        // Ví dụ: Log lỗi, chuyển hướng người dùng, hiển thị thông báo lỗi, v.v.
        return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi khi tạo sản phẩm');
    }
}


    public function store(StoreProductRequest $request)
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
            return redirect()->route('products.index')->with('successMessage', 'Thêm thành công')->with('products');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('errorMessage', 'Thêm thất bại');
        }
    }
    public function edit($id)
    {
        try {
            $item = Product::findOrFail($id);
            $this->authorize('update',  $item);
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
    public function update(UpdateProductRequest $request, $id)
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
            return redirect()->route('products.index')->with('successMessage', 'Cập nhật thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('errorMessage', 'Cập nhật thất bại');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('errorMessage', 'Cập nhật không thành công');
        }
    }
    public function destroy($id)
    {
        try {
            $item = Product::findOrFail($id);
            $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            Log::info('Product message', ['context' => 'value']);
            return redirect()->route('products.index')->with('successMessage', 'Xóa thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('errorMessage', 'Xóa thất bại');
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('errorMessage', 'Xóa không thành công');
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
