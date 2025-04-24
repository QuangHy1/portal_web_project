<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.admin.login_admin');
    }

    public function login(Request $request)
    {
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            $loginField => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            // Xác thực thành công, bây giờ kiểm tra vai trò admin
            if (Auth::user()->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            } else {
                // Không phải admin, đăng xuất và báo lỗi
                Auth::logout();
                return back()->withErrors(['login' => 'Tài khoản này không có quyền truy cập trang admin.']);
            }
        }

        return back()->withErrors(['login' => 'Sai thông tin đăng nhập.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
