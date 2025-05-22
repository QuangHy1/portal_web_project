<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\WebsiteMailController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class RecoverController extends Controller
{
    // Giao diện nhập email
    public function recoverEmployer()
    {
        return view('employer.recover');
    }

    public function recoverEmployee()
    {
        return view('employee.recover');
    }

    // Submit email (gửi OTP)
    public function recoverEmployerSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tìm user theo email và role employer
        $user = User::where('email', $request->email)->where('role_id', 3)->first();
        if (!$user) {
            return redirect()->route('employer.recover')->with('error', 'Email không tồn tại trong hệ thống');
        }

        // Kiểm tra tồn tại employer
        $employer = \App\Models\Employer::where('user_id', $user->id)->first();
        if (!$employer) {
            return redirect()->route('employer.recover')->with('error', 'Tài khoản này không thuộc vai trò nhà tuyển dụng');
        }

        // Tạo OTP
        $otp = rand(100000, 999999);
        $otp_expiration = now()->addMinutes(10);

        $user->otp_code = $otp;
        $user->otp_expires_at = $otp_expiration;
        $user->save();

        // Gửi mail
        $subject = 'Mã OTP khôi phục mật khẩu';
        $employer_name = $employer->employer_name ?? $user->username;

        $body = "
        <p>Mã này sẽ hết hạn sau <strong>10 phút</strong> kể từ thời điểm gửi.</p>
        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    ";

        Mail::to($user->email)->send(new \App\Mail\WebsiteMailController(
            $subject,
            $body,
            $employer_name,
            'admin.email.emailTemplate',
            $otp
        ));

        // Lưu session
        session([
            'recovery_email' => $user->email,
            'recovery_role' => 'employer'
        ]);

        return redirect()->route('employer.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn. Vui lòng kiểm tra hộp thư.');
    }


    public function recoverEmployeeSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tìm user theo email
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('employee.recover')->with('error', 'Email không tồn tại trong hệ thống');
        }

        // Kiểm tra vai trò là employee
        $employee = \App\Models\Employee::where('user_id', $user->id)->first();
        if (!$employee) {
            return redirect()->route('employee.recover')->with('error', 'Tài khoản này không thuộc vai trò người tìm việc');
        }

        // Tạo mã OTP
        $otp = rand(100000, 999999);
        $otp_expiration = now()->addMinutes(10);

        // Lưu OTP vào bảng users
        $user->otp_code = $otp;
        $user->otp_expires_at = $otp_expiration;
        $user->save();

        // Gửi email
        $subject = 'Mã OTP khôi phục mật khẩu';
        $user_name = $employee->firstname . ' ' . $employee->lastname;

        $body = "
        <p>Mã này sẽ hết hạn sau <strong>10 phút</strong> kể từ thời điểm gửi.</p>
        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    ";

        // Sử dụng mail view chuẩn
        Mail::to($user->email)->send(new \App\Mail\WebsiteMailController(
            $subject,
            $body,
            $user_name,
            'admin.email.emailTemplate',
            $otp
        ));

        // Lưu session cho bước OTP
        session([
            'recovery_email' => $user->email,
            'recovery_role' => 'employee'
        ]);

        return redirect()->route('employee.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn. Vui lòng kiểm tra hộp thư.');
    }


    // Giao diện OTP
    public function otpEmployerView()
    {
        return view('employer.otp');
    }

    public function otpEmployeeView()
    {
        return view('employee.otp');
    }

    // Xác thực OTP
    public function verifyOtpEmployer(Request $request)
    {
        $otp_input = implode('', $request->input('otp_code')); // Gộp 6 ô

        $request->merge(['otp_code' => $otp_input]);

        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->where('role_id', 3)->first(); // Đúng với employer

        if (
            !$user ||
            $user->otp_code !== $request->otp_code ||
            Carbon::now()->gt($user->otp_expires_at)
        ) {
            return redirect()->back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn. Vui lòng kiểm tra lại.');
        }

        return redirect()->route('employer.reset.password.view', ['email' => $user->email]);
    }


    public function verifyOtpEmployee(Request $request)
    {
        // Ghép các ký tự từ mảng `otp_code[]` thành chuỗi 6 số
        $otp_input = implode('', $request->input('otp_code'));

        // Thêm lại vào request để validate đúng
        $request->merge(['otp_code' => $otp_input]);

        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->where('role_id', 4)->first(); // Đúng với employee

        if (
            !$user ||
            $user->otp_code !== $request->otp_code ||
            Carbon::now()->gt($user->otp_expires_at)
        ) {
            return redirect()->back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn. Vui lòng kiểm tra lại.');
        }

        return redirect()->route('employee.reset.password.view', ['email' => $user->email]);
    }



    // Giao diện đổi mật khẩu
    public function resetPasswordEmployerView(Request $request)
    {
        return view('employer.resetPassword', ['email' => $request->email]);
    }

    public function resetPasswordEmployeeView(Request $request)
    {
        return view('employee.resetPassword', ['email' => $request->email]);
    }

    // Submit đổi mật khẩu
    public function resetPasswordEmployerSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->where('role_id', 3)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại.');
        }

        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('employer.signin')->with('success', 'Đổi mật khẩu hoàn tất. Tiến hành đăng nhập.');
    }

    public function resetPasswordEmployeeSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->where('role_id', 4)->first(); // Sửa ở đây

        if (!$user) {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại.');
        }

        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('employee.signin')->with('success', 'Đổi mật khẩu hoàn tất. Tiến hành đăng nhập.');
    }
}

