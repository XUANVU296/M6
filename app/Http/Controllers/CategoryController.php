<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('viewAny', Category::class);
        $keyword = $request->input('keyword');
        $categories = Category::orderBy('id', 'DESC')->paginate(4);

        if ($keyword) {
            $categories = Category::where('name', 'like', "%$keyword%")->paginate(4);
        }

        return view('admin.categories.index', compact('categories', 'keyword'));
    }
    public function create()
    {
        // $this->authorize('create', Category::class);

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $item = new Category();
            $item->name = $request->name;
            $item->save();


            Log::info('Category stored successfully. ID: ' . $item->id);
            return redirect()->route('categories.index')->with('successMessage','Thêm thành công');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('errorMessage','Thêm thất bại');
        }
    }
    public function edit($id)
    {
        try {
            $item = Category::findOrFail($id);
            // $this->authorize('update',  $item);
            $params = [
                'item' => $item
            ];
            return view("admin.categories.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        }
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $item = Category::findOrFail($id);
            $item->name = $request->name;
            $item->save();
            Log::info('Category updated', ['id' => $item->id]);
            return redirect()->route('categories.index')->with('successMessage','Cập nhật thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('errorMessage', 'Cập nhật thất bại');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('errorMessage','Cập nhật không thành công');
        }
    }
    public function destroy($id)
    {
        try {
            $item = Category::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            Log::info('Category message', ['context' => 'value']);
            return redirect()->route('categories.index')->with('successMessage','Xóa thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('errorMessage','Xóa thất bại');
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('errorMessage','Xóa không thành công');
        }
    }
}
