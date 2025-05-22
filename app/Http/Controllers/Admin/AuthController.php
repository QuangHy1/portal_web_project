<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\WebsiteMailController;
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
            'g-recaptcha-response' => 'required',
        ]);

        // Xác thực reCAPTCHA
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . env('GOOGLE_RECAPTCHA_SECRET_KEY') . '&response=' . $request->input('g-recaptcha-response'));
        $responseKeys = json_decode($response, true);

//        if (!$responseKeys["success"]) {
//            return back()->with('error', 'Vui lòng xác minh bạn không phải là robot.');
//        }

        // Tìm user theo login field
        $user = \App\Models\User::where($loginField, $request->input('login'))->first();

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                if ($user->isAdmin()) {
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->intended(route('admin.dashboard'))->with('success', 'Đăng nhập thành công!');
                } else {
                    return back()->with('error', 'Tài khoản này không có quyền truy cập trang admin.');
                }
            } else {
                return back()->with('error', 'Mật khẩu không đúng.');
            }
        } else {
            return back()->with('error', 'Tài khoản không tồn tại.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }


    // Khôi phục mật khẩu admin
    public function recoverAdmin()
    {
        return view('admin.recover');
    }

    public function recoverAdminSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tìm user theo email
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('admin.recover')->with('error', 'Email không tồn tại trong hệ thống');
        }

        // Kiểm tra vai trò là admin
        $admin = \App\Models\Admin::where('user_id', $user->id)->first();
        if (!$admin) {
            return redirect()->route('admin.recover')->with('error', 'Tài khoản này không thuộc vai trò admin');
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
        $user_name = $admin->firstname . ' ' . $admin->lastname;

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
            'recovery_role' => 'admin'
        ]);

        return redirect()->route('admin.otp')->with('success', 'Mã OTP đã được gửi đến email của bạn. Vui lòng kiểm tra hộp thư.');
    }

    public function otpAdminView()
    {
        return view('admin.otp');
    }

    public function verifyOtpAdmin(Request $request)
    {
        // Ghép các ký tự từ mảng `otp_code[]` thành chuỗi 6 số
        $otp_input = implode('', $request->input('otp_code'));

        // Thêm lại vào request để validate đúng
        $request->merge(['otp_code' => $otp_input]);

        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->where('role_id', 1)->first(); // Đúng với admin

        if (
            !$user ||
            $user->otp_code !== $request->otp_code ||
            Carbon::now()->gt($user->otp_expires_at)
        ) {
            return redirect()->back()->with('error', 'Mã OTP không chính xác hoặc đã hết hạn. Vui lòng kiểm tra lại.');
        }

        return redirect()->route('admin.reset.password.view', ['email' => $user->email]);
    }

    public function resetPasswordAdminView(Request $request)
    {
        return view('admin.resetPassword', ['email' => $request->email]);
    }

    public function resetPasswordAdminSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->where('role_id', 1)->first(); // Sửa ở đây

        if (!$user) {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại.');
        }

        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('admin.login')->with('success', 'Đổi mật khẩu hoàn tất. Tiến hành đăng nhập.');
    }
}
