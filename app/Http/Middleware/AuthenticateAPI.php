<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu route không phải là 'login' hoặc 'register'
        if (!$request->is('api/login') && !$request->is('api/register')) {
            // Kiểm tra header Authorization
            if (!$request->header('Authorization')) {
                // Nếu không có token xác thực, trả về lỗi 401
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        // Tiếp tục xử lý request
        return $next($request);
    }
}
