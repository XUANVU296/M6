<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('customers')->attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $customer = Auth::guard('customers')->user();
        return response()->json([
            'customer' => $customer,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'customer' => $customer
        ]);
    }

    public function logout(Request $request)
    {
        $customer = $request->user();
        if ($customer) {
            $customer->tokens()->delete();
            Auth::guard('customers')->logout();
        }
        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    public function refresh()
    {
        return response()->json([
            'customer' => Auth::guard('customers')->user(),
            'authorization' => [
                'token' => Auth::guard('customers')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}