<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cổng Thông Tin Việc Làm</title>
    <link rel="stylesheet" href="{{ asset('login/css/login_editor.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<!-- LOGIN FORM CREATION -->
<div class="background"></div>
<div class="container">
    <div class="item">
        <h2 class="logo"><i class='bx bxl-xing'></i>PORTAL JOB</h2>
        <a href="{{ route('home') }}" class="home-icon-link">
            <i class='bx bxs-home home-icon'></i>
        </a>
        <div class="text-item">
            <h2>Trang đăng nhập EDITOR<br><span>
                    ---
                </span></h2>
            <p>Trang đăng nhập dành cho người chỉnh sửa.</p>
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
            <form action="" class="login-form">
                <h2>Đăng nhập</h2>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="text" required>
                    <label >Tên đăng nhập/email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" required>
                    <label>Mật khẩu</label>
                </div>
                <div class="remember-password">
                    <label for=""><input type="checkbox">Ghi nhớ tài khoản</label>
                    <a href="#">Quên mật khẩu</a>
                </div>

                <!-- ✅ reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>

                <button class="btn btn-login-admin">Đăng nhập</button>

            </form>
        </div>
    </div>
</div>
<!-- SIGN UP FORM CREATION -->
<script src="{{ asset('login/js/login_editor.js') }}"></script>
</body>

</html>
