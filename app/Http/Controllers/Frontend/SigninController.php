<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    // ====== Views ======
    public function index()
    {
        $companies = Company::all();
        return view('login.employer.login_employer', compact('companies'));
    }

    public function employee()
    {
        return view('login.employee.login_employee');
    }

    // ====== Đăng nhập EMPLOYER ======
    public function signinSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required',
        ]);

        // Xác thực reCAPTCHA
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . env('GOOGLE_RECAPTCHA_SECRET_KEY') . '&response=' . $request->input('g-recaptcha-response'));
        $responseKeys = json_decode($response, true);

//        if (!$responseKeys["success"]) {
//            return back()->with('error', 'Vui lòng xác minh bạn không phải là người máy.');
//        }

        $user = User::where(function ($query) use ($request) {
            $query->where('username', $request->username)
                ->orWhere('email', $request->username);
        })
            ->where('role_id', 3) // Employer
            ->first();

        if (!$user) {
            return redirect()->route('employer.signin')->with('error', 'Không tìm thấy tài khoản của bạn.');
        }
        // ✅ Kiểm tra trạng thái tài khoản
        if ($user->status !== 'active') {
            return redirect()->route('employer.signin')->with('error', 'Tài khoản chưa được kích hoạt.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('employer.signin')->with('error', 'Mật khẩu không chính xác.');
        }

        $employer = $user->employer;

        if (!$employer || !$employer->isverified) {
            return redirect()->route('employer.signin')->with('error', 'Email chưa được xác minh.');
        }

        if ($employer->isSuspended === 'yes') {
            return redirect()->route('employer.signin')->with('error', 'Tài khoản bị đình chỉ hoạt động.');
        }

        Auth::guard('employer')->login($user);
        return redirect()->route('employer.dashboard');
    }

    // ====== Đăng nhập EMPLOYEE ======
    public function signinSubmitEmployee(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required',

        ]);

        // Kiểm tra dữ liệu reCAPTCHA gửi về
        //dd($request->input('g-recaptcha-response'));
        // Xác thực reCAPTCHA
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . env('GOOGLE_RECAPTCHA_SECRET_KEY') . '&response=' . $request->input('g-recaptcha-response'));
        $responseKeys = json_decode($response, true);

        $user = User::where(function ($query) use ($request) {
            $query->where('username', $request->username)
                ->orWhere('email', $request->username);
        })
            ->where('role_id', 4) // Employee
            ->first();

        if (!$user) {
            return redirect()->route('employee.signin')->with('error', 'Không tìm thấy tài khoản của bạn.');
        }

        if ($user->status !== 'active') {
            return redirect()->route('employee.signin')->with('error', 'Tài khoản chưa được kích hoạt.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('employee.signin')->with('error', 'Mật khẩu không chính xác.');
        }

        $employee = $user->employee;

        if (!$employee || !$employee->isverified) {
            return redirect()->route('employee.signin')->with('error', 'Email chưa được xác minh.');
        }

        if ($employee->isDeleted) {
            return redirect()->route('employee.signin')->with('error', 'Tài khoản đã bị xóa tại ' . $employee->updated_at->diffForHumans());
        }

        Auth::guard('employee')->login($user);
        return redirect()->route('employee.dashboard');
    }

    // ====== Đăng xuất ======
    public function employerLogout()
    {
        Auth::guard('employer')->logout();
        return redirect()->route('employer.signin');
    }

    public function employeeLogout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.signin');
    }

    // ====== Đổi mật khẩu EMPLOYER ======
    public function changePasswordEmployer()
    {
        return view('employer.changepassword');
    }

    public function changePasswordEmployerConfirm(Request $request)
    {
        $request->validate([
            'oldpassword'      => 'required',
            'newpassword'      => 'required|min:6',
            'confirmpassword'  => 'required|same:newpassword',
        ]);

        $user = Auth::guard('employer')->user();

        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        // Đăng xuất sau khi đổi mật khẩu
        Auth::guard('employer')->logout();

        // Chuyển về trang đăng nhập
        return redirect()->route('employer.signin')->with('success', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại.');
    }
    // ====== Đổi mật khẩu EMPLOYEE ======
    public function changePasswordEmployee()
    {
        return view('employee.changepassword');
    }

    public function changePasswordEmployeeConfirm(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirmpassword' => 'required|same:newpassword',
        ]);

        $user = Auth::guard('employee')->user();

        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        // Đăng xuất sau khi đổi mật khẩu
        Auth::guard('employee')->logout();

        // Chuyển về trang đăng nhập
        return redirect()->route('employee.signin')->with('success', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập lại.');
    }
}
