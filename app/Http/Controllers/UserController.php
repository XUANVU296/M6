<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequet;
use App\Http\Requests\ProductRequest;
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
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::with('groups');

        $users = User::all();
        // $users = User::search()->paginate(4);
        $param = [
            'users' => $users,
        ];
        return view('admin.users.index', $param);
    }

    public function showAdmin()
    {
        $admins = User::get();
        $param = [
            'admins' => $admins,
        ];
        return view('user.admin', $param);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $groups = Group::get();
        $param = [
            'groups' => $groups,
        ];
        return view('admin.users.add', $param);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
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
                $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }
        $user->save();

        $data = [
            'name' => $request->name,
            'pass' => $request->password,
        ];



        return redirect()->route('user.index')->with('success', __('sys.store_item_success12'));
    }

    public function show($id)
    {
        $this->authorize('view', User::class);
        $user = User::findOrFail($id);
        $param =[
            'user'=>$user,
        ];


        // $productshow-> show();
        return view('user.profile', $param);
    }

    public function edit($id)
    {
        $this->authorize('view', User::class);
        $user = User::find($id);
        $groups=Group::get();
        $param = [
            'user' => $user ,
            'groups' => $groups
        ];
        return view('admin.users.edit', $param);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
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
                $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }
        $user->save();
        $notification = [
            'message' => 'Chỉnh Sửa Thành Công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.index')->with($notification);
    }

    // hiển thị form đổi mật khẩu
    public function editpass($id)
    {
        $this->authorize('view', User::class);
        $user = User::find($id);
        $param =[
            'user'=>$user,
        ];
        return view('user.editpass', $param);
    }

     // hiển thị form đổi mật khẩu
     public function adminpass($id)
     {
         $this->authorize('adminUpdatePass', User::class);
         $user = User::find($id);
         $param =[
             'user'=>$user,
         ];
         return view('user.adminpass', $param);
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
            return redirect()->route('user.index')->with($notification);
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
                return redirect()->route('user.index')->with($notification);
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
            return dd(__METHOD__);
        }
    }
}
