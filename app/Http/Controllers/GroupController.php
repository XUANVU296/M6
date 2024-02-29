<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

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
}
