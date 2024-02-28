<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        try {
            $item = new Category();
            $item->name = $request->name;
            $item->save();


            Log::info('Category stored successfully. ID: ' . $item->id);
            return redirect()->route('categories.index')->with('success', __('sys.store_item_success'))->with('categories');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.store_item_error'));
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
    public function update(Request $request, $id)
    {
        try {
            $item = Category::findOrFail($id);
            $item->name = $request->name;
            $item->save();
            Log::info('Category updated', ['id' => $item->id]);
            return redirect()->route('categories.index')->with('success', __('sys.update_item_success'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.update_item_error'));
        }
    }
    public function destroy($id)
    {
        try {
            $item = Category::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            Log::info('Category message', ['context' => 'value']);
            return redirect()->route('categories.index')->with('success', __('sys.destroy_item_success1'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.item_not_found'));
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', __('sys.destroy_item_error'));
        }
    }
}
