<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::orderBy('id', 'DESC')->with('group');
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
    $users = $query->paginate(3);
    return view('admin.users.index', compact('users'));
}
public function create()
{
    $groups = Group::all();
    return view('admin.users.create',compact('groups'));
}
public function store(StoreUserRequest $request)
{
    try {
        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->phone = $request->phone;
        $item->group_id = $request->group_id;
        $item->password = Hash::make($request->password);
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
        return redirect()->route('users.index')->with('successMessage','Thêm người dùng thành công');
    } catch (QueryException $e) {
        Log::error($e->getMessage());
        return redirect()->route('users.index')->with('errorMessage','Thêm thất bại');
    }
}
public function edit($id)
    {
        try {
            $item = User::findOrFail($id);
            $groups = Group::all();
            // $this->authorize('update',  $item);
            $params = [
                'item' => $item,
                'groups' => $groups
            ];
            return view("admin.users.edit", $params);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('errorMessage','Bạn không có quyền truy cập vào trang chỉnh sửa');
        }
    }
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $item = User::findOrFail($id);
            $item->name = $request->name;
            $item->email = $request->email;
            $item->phone = $request->phone;
            $item->group_id = $request->group_id;
            $item->password = Hash::make($request->password);
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
            return redirect()->route('users.index')->with('successMessage','Cập nhật thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('errorMessage', 'Cập nhật thất bại');
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('errorMessage','Cập nhật không thành công');
        }
    }
    public function destroy($id)
    {
        try {
            $item = User::findOrFail($id);
            // $this->authorize('delete', $item);
            $item->forceDelete(); // Xóa vĩnh viễn mục từ thùng rác
            return redirect()->route('users.index')->with('successMessage','Xóa người dùng thành công');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('errorMessage','Xóa thất bại');
        } catch (QueryException  $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('errorMessage','Xóa không thành công');
        }
    }
}