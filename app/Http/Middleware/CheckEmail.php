<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // if (filter_var($email = $request->input('email'), FILTER_VALIDATE_EMAIL)) {
        //     // Email hợp lệ
        //     return $next($request);

        // } else {
        //     // Email không hợp lệ
        //     $errorMessage = 'Email không đúng';
        //     return new Response($errorMessage, 400); // Trả về một đối tượng Response với mã lỗi 400 (Bad Request) và thông báo lỗi
        // }
            if ($number = $request->input('number') % 2 == 0) {
                return $next($request);
                return 'xin chào';
            } else {

                return 'không xin chào';
            }


    }
}
