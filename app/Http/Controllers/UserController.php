<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() {
     try {
        $this->authorize('viewAny', User::class);

        // Lấy danh sách người dùng
        $users = User::with('groups')->get();

        // Truyền dữ liệu sang view
        $param = [
            'users' => $users,
        ];

        // Hiển thị view
        return view('admin.users.index', $param);
     } catch (\Exception $e) {
        // Xử lý ngoại lệ
        return back()->withError($e->getMessage());
     }
 }
    public function showAdmin() {
        $admins = User::get();
        $param = [
            'admins' => $admins,
        ];
        return view('admin', $param);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    try {
        $this->authorize('create', User::class);

        // Lấy danh sách các nhóm
        $groups = Group::get();

        // Truyền dữ liệu sang view
        $param = [
            'groups' => $groups,
        ];

        // Hiển thị view
        return view('admin.users.add', $param);
    } catch (\Exception $e) {
        // Xử lý ngoại lệ
        return back()->withError($e->getMessage());
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
{
    try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // $user->address = $request->address;
        $user->phone = $request->phone;
        // $user->birthday = $request->birthday;
        // $user->position = $request->position;
        $user->group_id = $request->group_id;

        $fieldName = 'image';
        if ($request->hasFile($fieldName)) {
            // Xử lý tải lên hình ảnh mới nếu có
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extension = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extension;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $user->image = $path;
        }

        // Lưu thông tin người dùng
        $user->save();

        return redirect()->route('user.index')->with('successMessage','Đăng ký tài khoản thành công');

        return redirect()->route('user.index')->with('successMessage', 'Thêm thành công');
    } catch (\Exception $e) {
        // Xử lý ngoại lệ
        return back()->withError($e->getMessage());

    }
}


    public function show(User $user, $id)
    {
        $this->authorize('view', User::class);
        $user = User::findOrFail($id);
        $userId = $user->id;
        $param =[
            'user'=>$user,
        ];


        // $productshow-> show();
        return view('user.profile', $param);
    }

    public function edit($id)
{
    try {
        $this->authorize('view', User::class);

        // Lấy thông tin người dùng cần chỉnh sửa
        $user = User::findOrFail($id);

        // Lấy danh sách các nhóm
        $groups = Group::get();

        // Truyền dữ liệu sang view
        $param = [
            'user' => $user,
            'groups' => $groups
        ];

        // Hiển thị view
        return view('admin.users.edit', $param);
    } catch (\Exception $e) {
        // Xử lý ngoại lệ
        return back()->withError($e->getMessage());
    }
}


public function update(UpdateUserRequest $request, $id)
{
    try {
        $user = User::find($id);
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->group_id = $request->group_id;
        $fieldName = 'image';
        if ($request->hasFile($fieldName)) {
            // Xử lý tải lên hình ảnh mới nếu cần thiết
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extension = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extension;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $user->image = $path;
        }
        $user->save();

        $successMessage = [
            'message' => 'Chỉnh Sửa Thành Công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.index')->with('successMessage','Cập nhật thành công');
        return redirect()->route('users.index')->with($successMessage);
    } catch (\Exception $e) {
        // Xử lý ngoại lệ
        return back()->withError($e->getMessage());
    }
}

    // hiển thị form đổi mật khẩu
    public function editpass($id)
    {
        $this->authorize('view', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('users.editpass', $param);
    }

     // hiển thị form đổi mật khẩu
     public function adminpass($id)
     {
         $this->authorize('adminUpdatePass', User::class);
         $user = User::find($id);
         $param =[
             'user'=>$user,
         ];
         return view('users.adminpass', $param);
     }

    // chỉ có superAdmin mới có quyền đổi mật khẩu người kh
    public function adminUpdatePass(Request $request, $id)
    {
        $this->authorize('adminUpdatePass', User::class);
        $user = User::find($id);
        if ($request->renewpassword==$request->newpassword) {
            $item = User::find($id);
            $item->password= bcrypt($request->newpassword);
            $item->save();
            $notification = [
                'message' => 'Đổi mật khẩu thành công!',
                'alert-type' => 'success'
            ];
            return redirect()->route('users.index')->with($notification);
        } else {
            $notification = [
                'sainhap' => 'Bạn nhập mật khẩu không trùng khớp!',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }
    }

    public function updatepass(UserRequet $request)
    {
        if($request->renewpassword==$request->newpassword)
        {
            if ((Hash::check($request->password, Auth::user()->password))) {
                $item=User::find(Auth()->user()->id);
                $item->password= bcrypt($request->newpassword);
                $item->save();
                $notification = [
                    'message' => 'Đổi mật khẩu thành công!',
                    'alert-type' => 'success'
                ];
                return redirect()->route('users.index')->with($notification);
            }else{
                // dd($request);
                $notification = [
                    'saipass' => '!',

                ];
                return back()->with($notification);
            }
        }else{
            $notification = [
                'sainhap' => '!',
            ];
            return back()->with($notification);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->authorize('forceDelete', Product::class);
        $notification = [
            'sainhap' => '!',
        ];

        $user = User::find($id);
        if($user->group->name!='Super Admin'){
            $user->delete();
        }
        else{
            return redirect()->route('user.index')->with('successMessage','Xóa thành công');
            return dd(__METHOD__);
        }
    }
}