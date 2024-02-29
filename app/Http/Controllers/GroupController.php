<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    public function index(Request $request)
{
    $query = Group::orderBy('id', 'DESC');
    if ($request->filled('search_name')) {
        $query->where(function($query) use ($request) {
            if ($request->filled('search_name')) {
                $query->where('name', 'like', "%{$request->input('search_name')}%");
            }
        });
    }
    $groups = $query->paginate(4);
    return view('admin.groups.index', compact('groups'));
}
public function create()
{
    return view('admin.groups.create');
}
public function store(StoreGroupRequest $request)
{
    try {
        $item = new Group();
        $item->name = $request->name;
        $item->save();
        return redirect()->route('groups.index')->with('successMessage','Thêm chức vụ thành công');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->route('groups.index')->with('errorMessage','Thêm thất bại');
    }
}
public function edit($id)
    {
        try {
            $item = Group::findOrFail($id);
            // $this->authorize('update',  $item);
            $params = [
                'item' => $item
            ];
            return view("admin.groups.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('errorMessage','Bạn không có quyền truy cập vào trang chỉnh sửa');
        }
    }
    public function update(UpdateGroupRequest $request, $id)
    {
        try {
            $item = Group::findOrFail($id);
            $item->name = $request->name;
            $item->save();
            return redirect()->route('groups.index')->with('successMessage','Cập nhật thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('errorMessage', 'Cập nhật thất bại');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('errorMessage','Cập nhật không thành công');
        }
    }
    public function destroy($id)
    {
        try {
            $item = Group::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            return redirect()->route('groups.index')->with('successMessage','Xóa chức vụ thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('errorMessage','Xóa thất bại');
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('errorMessage','Xóa không thành công');
        }
    }
}
