<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $member = Auth::user();

        if (Hash::check($request->current_password, $member->password)) {
            $member->password = Hash::make($request->new_password);
            $member->save();

            return redirect()->route('login')->with('successMessage','Mật khẩu đã được thay đổi thành công');
        } else {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }
    }
}
