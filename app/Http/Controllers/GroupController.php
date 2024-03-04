<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Group::query(true);

        if ($request->name) {
            $query->where('name', $request->name);
        }

        $groups = $query->paginate(5);

        $param = [
            'groups' => $groups,
        ];

        return view('admin.groups.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create',Group::class);

        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $userGroup = new Group();
        $userGroup->name = $request->name;
        $userGroup->save();
        try {
            $userGroup->save();
            return redirect()->route('groups.index')->with('success', __('Thêm thành công'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('error', __('Thêm thất bại'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->save();
        $notification = [
            'message' => 'Chỉnh Sửa Thành Công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('groups.index')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        return redirect()->route('groups.index');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $group = Group::find($id);

        $current_user = Auth::user();
        $userRoles = [];
        if ($group->role) {
            $userRoles = $group->role->pluck('id', 'name')->toArray();
        }

        $roles = Role::all()->toArray();
        $group_names = [];
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }

        $params = [
            'group' => $group,
            'userRoles' => $userRoles,
            'roles' => $roles,
            'group_names' => $group_names,
        ];

        return view('admin.groups.detail', $params);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function group_detail(Request $request, $id)
    {
        try {
            $group = Group::find($id);
            $group->role()->detach();
            $group->role()->attach($request->roles);

            return redirect()->route('groups.index')->with('success', __('sys.store_item_success11'));
        } catch (\Exception $e) {
            return redirect()->route('groups.index')->with('error', __('Cấp quyền thất bại'));
        }
    }
public function edit($id)
    {
        $userGroup = Group::find($id);
        // $this->authorize('update',  $userGroup);

        $roles = Role::all()->toArray();
        $group_names = [];
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }
        $params = [

            'group_names' => $group_names,
            'userGroup' => $userGroup
        ];
        return view('admin.groups.edit', compact('userGroup') );
    }

}

