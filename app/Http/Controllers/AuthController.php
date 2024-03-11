<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('categories.index');
        } else {
            return view('admin.login');
        }
    }

    public function checklogin(Request $request)
    {
        // dd($request);
        try {
            $messages = [
                "email.exists" => "Email không đúng",
                "password.exists" => "Mật khẩu không đúng",
            ];
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ], $messages);
            $data = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($data)) {
                $previousUrl = session()->pull('previous_url', '/dashboard');
                if ($previousUrl === route('/login-admin')) {
                    return redirect()->route('categories.index')->with('successMessage', 'Đăng nhập thành công');
                }
            } else {
                return redirect()->back()->with('errorMessage', 'Đăng nhập thất bại');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi trong quá trình đăng nhập');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function googleLogin()
    {
        return Socialite::driver('google')->scopes(['email', 'profile'])->redirect();
    }
    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')->user();
        $user = User::firstOrNew(['email' => $socialUser->getEmail()]);
        if (!$user->exists) {
            $user->name = $socialUser->getName();
            $user->remember_token = Str::random(60);
            $user->group_id = 0;
            $user->save();
        }
        auth()->login($user);
        return redirect()->route('categories.index')->with('successMessage', 'Đăng nhập thành công');
    }
    public function showLinkRequestForm()
    {
        return view('forgetPassword');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) return back()->withErrors(['email' => 'Không tìm thấy email này']);
        $token = Str::random(10);
        $user->token = $token;
        $user->reset_at = now();
        $user->save();
        Mail::send('forgetPass', compact('user'), function ($email) use ($user) {
            $email->subject('Forgot Password');
            $email->to($user->email, $user->name);
        });
        return back()->with('message', 'Vui lòng kiểm tra email của bạn!');
    }
}
