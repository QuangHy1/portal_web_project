<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cổng Thông Tin Việc Làm</title>
    <link rel="stylesheet" href="{{ asset('login/css/login_employer.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Lỗi đăng nhập',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif
<!-- LOGIN FORM CREATION -->
<div class="background"></div>
<div class="container">
    <div class="item">
        <h2 class="logo"><i class='bx bxl-xing'></i>PORTAL JOB</h2>
        <a href="{{ route('home') }}" class="home-icon-link">
            <i class='bx bxs-home home-icon'></i>
        </a>
        <div class="text-item">
            <h2>Trang đăng nhập nhà tuyển dụng ! <br><span>
                    ---
                </span></h2>
            <p>Cùng nhau mang đến cơ hội việc làm cho mọi người.</p>
            <div class="social-icon">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
                <a href="#"><i class='bx bxl-youtube'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
    </div>
    <div class="login-section">
        <div class="form-box login">
{{--            @if (session('error'))--}}
{{--                <div class="alert alert-danger">--}}
{{--                    {{ session('error') }}--}}
{{--                </div>--}}
{{--            @endif--}}
                <form action="{{ route('employer.signin.submit') }}" method="POST" class="login-form">
                    @csrf
                <h2 class="login-label">Đăng nhập</h2>
                <div class="input-box input-box-login">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="text" name="username" value="{{ old('username') }}" required>
                    <label >Tên đăng nhập/email</label>
                </div>
                <div class="input-box input-box-login">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" name="password" required>
                    <label>Mật khẩu</label>
                </div>
                <div class="remember-password">
                    <label for=""><input type="checkbox">Ghi nhớ tài khoản</label>
                    <a href="#">Quên mật khẩu</a>
                </div>

                <!-- ✅ reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LcozD8rAAAAAL1lqZUpdiYBjbzLXcLf0SQl5VWe"></div>

                <button type="submit" class="btn">Đăng nhập</button>

                <!-- Hoặc đăng nhập bằng -->
                <div class="social-login">
                    <p> -- Hoặc đăng nhập bằng --</p>
                    <div class="social-buttons">
                        <a href="#" class="social-btn google"><i class='bx bxl-google'></i> Google</a>
                        <a href="#" class="social-btn facebook"><i class='bx bxl-facebook'></i> Facebook</a>
                        <a href="#" class="social-btn linkedin"><i class='bx bxl-linkedin'></i> LinkedIn</a>
                    </div>
                </div>

                <div class="create-account">
                    <p>Bạn chưa có tài khoản? <a href="#" class="register-link">Đăng kí ngay</a></p>
                </div>
            </form>
        </div>
        <div class="form-box register">
            <form action="" class="register-form">

                <h2 class="register-label">Đăng ký</h2>

                <div class="input-box input-box-register">
                    <span class="icon"><i class='bx bxs-user'></i></span>
                    <input type="text" required>
                    <label >Tên đăng nhập</label>
                </div>
                <div class="input-box input-box-register">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" required>
                    <label >Email</label>
                </div>
                <div class="input-box input-box-register">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" required>
                    <label>Mật khẩu</label>
                </div>
                <div class="input-box input-box-register">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" required>
                    <label>Xác nhận lại mật khẩu</label>
                </div>
                <div class="remember-password">
                    <label for=""><input type="checkbox">Đồng ý với Điều khoản dịch vụ và Chính sách bảo mật.</label>
                </div>
                <button class="btn">Đăng ký</button>
                <div class="create-account">
                    <p>Bạn đã có tài khoản?  <a href="#" class="login-link"> Đăng nhập ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SIGN UP FORM CREATION -->
<script src="{{ asset('login/js/login_employer.js') }}"></script>
</body>

</html>
