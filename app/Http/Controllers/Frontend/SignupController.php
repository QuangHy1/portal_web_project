<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use App\Models\Employer;
use App\Mail\VerifyEmail;

class SignupController extends Controller
{
    // Hiển thị form đăng ký Employee
    public function showEmployeeForm()
    {
        return view('login.employee.login_employee');
    }

    // Hiển thị form đăng ký Employer
    public function showEmployerForm()
    {
        $companies = Company::all();
        return view('login.employer.login_employer', compact('companies'));
    }

    // Xử lý đăng ký Employee
    public function registerEmployee(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Xóa user cũ nếu chưa xác thực và bị trùng email/username
        $existingUser = User::where(function ($query) use ($request) {
            $query->where('username', $request->username)
                ->orWhere('email', $request->email);
        })
            ->where('status', 'inactive')
            ->first();

        if ($existingUser) {
            // Xóa employee nếu có
            Employee::where('user_id', $existingUser->id)->delete();
            $existingUser->delete();
        }

        // Tạo user
        $user = User::create([
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => 4, // Employee
            'status'     => 'inactive',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sinh token
        $token = Str::random(64);

        $employee = Employee::create([
            'user_id'   => $user->id,
            'firstname' => fake()->firstName,
            'lastname'  => fake()->lastName,
            'isverified'=> 0,
            'token'     => $token,
        ]);

        $user_name = $employee->firstname . ' ' . $employee->lastname;

        $body = "
        <p>Chào bạn <strong>{$user_name}</strong>,</p>
        <p>Cảm ơn bạn đã đăng ký tài khoản Employee trên hệ thống của chúng tôi.</p>
        <p>Vui lòng nhấn vào link bên dưới để xác thực địa chỉ email và kích hoạt tài khoản của bạn.</p>
        <p>Nếu bạn không đăng ký, vui lòng bỏ qua email này.</p>
    ";

        Mail::to($user->email)->send(new VerifyEmail(
            $user->email,
            $token,
            $user_name,
            $body
        ));

        return view('frontend.verify');
    }


    // Xử lý đăng ký Employer
    public function registerEmployer(Request $request)
    {
        $request->validate([
            'username'   => 'required',
            'email'      => 'required|email',
            'password'   => 'required|confirmed|min:6',
            'company_id' => 'required|exists:companies,id',
        ]);

        $existingUser = User::where(function ($query) use ($request) {
            $query->where('username', $request->username)
                ->orWhere('email', $request->email);
        })
            ->where('status', 'inactive')
            ->first();

        if ($existingUser) {
            Employer::where('user_id', $existingUser->id)->delete();
            $existingUser->delete();
        }

        $user = User::create([
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => 3, // Employer
            'status'     => 'inactive',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $token = Str::random(64);

        $employer = Employer::create([
            'user_id'    => $user->id,
            'company_id' => $request->company_id,
            'firstname'  => fake()->firstName,
            'lastname'   => fake()->lastName,
            'isverified' => 0,
            'token'      => $token,
        ]);

        $user_name = $employer->firstname . ' ' . $employer->lastname;
        $body = '
        <p>Vui lòng nhấn vào nút bên dưới để xác thực email của bạn.</p>
        <p>Sau khi xác minh, tài khoản của bạn sẽ được chuyển đến quản trị viên để phê duyệt.</p>
        <p>Nếu bạn không yêu cầu đăng ký, vui lòng bỏ qua email này.</p>
    ';

        Mail::to($user->email)->send(new VerifyEmail(
            $user->email,
            $token,
            $user_name,
            $body
        ));

        return view('frontend.verifyemployer');
    }




    // Xác minh email
    public function verifyEmail(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');

        if (empty($email) || empty($token)) {
            return redirect('/')->with('error', 'Thông tin xác minh không đầy đủ!');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Email không tồn tại!');
        }

        if ($user->role_id == 4) {
            // Employee
            if ($user->status === 'active') {
                return redirect('/login')->with('message', 'Tài khoản đã được kích hoạt. Vui lòng đăng nhập.');
            }

            $employee = Employee::where('user_id', $user->id)->where('token', $token)->first();

            if (!$employee) {
                return redirect('/')->with('error', 'Token không hợp lệ hoặc đã sử dụng!');
            }

            $employee->isverified = 1;
            $employee->token = null;
            $employee->save();

            $user->status = 'active';
            $user->email_verified_at = now();
            $user->save();

            return view('frontend.verified');
        } elseif ($user->role_id == 3) {
            // Employer
            $employer = Employer::where('user_id', $user->id)->where('token', $token)->first();

            if (!$employer) {
                return redirect('/')->with('error', 'Token không hợp lệ hoặc đã sử dụng!');
            }

            $employer->isverified = 1;
            $employer->token = null;
            $employer->save();

            // Cập nhật ngày xác minh email
            $user->email_verified_at = now();
            $user->save();

            // Không kích hoạt user ngay, đợi admin duyệt
            return view('frontend.verifiedemployer');
        }

        return redirect('/')->with('error', 'Vai trò không hợp lệ!');
    }
}
