<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cổng Thông Tin Việc Làm</title>
    <link rel="stylesheet" href="{{ asset('login/css/login_admin.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontEndAssets/img/favicon-32x32.png') }}">
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
            <h2>Trang đăng nhập ADMIN<br><span>
                    ---
                </span></h2>
            <p>Trang đăng nhập dành cho quản trị viên.</p>
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
            <form method="POST" action="{{ route('admin.login') }}" class="login-form">
                @csrf

                <h2>Đăng nhập</h2>

                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="text" name="login" value="{{ old('login') }}" required>
                    <label>Tên đăng nhập/email</label>
                </div>
                <div class="input-box input-box-login">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password" name="password" id="login-password" required>
                    <span class="toggle-password" toggle="#login-password"><i class='bx bx-show'></i></span>
                    <label>Mật khẩu</label>
                </div>
                <div class="remember-password">
                    <label for=""><input type="checkbox">Ghi nhớ tài khoản</label>
                    <a href="{{ route('admin.recover') }}">Quên mật khẩu</a>
                </div>

                <!-- ✅ reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LcozD8rAAAAAL1lqZUpdiYBjbzLXcLf0SQl5VWe"></div>

                <button class="btn btn-login-admin">Đăng nhập</button>

            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('.login-form').addEventListener('submit', function(e) {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Vui lòng xác minh',
                text: 'Bạn cần xác nhận rằng bạn không phải người máy.'
            });
        }
    });
</script>
<script>
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function () {
            const input = document.querySelector(this.getAttribute('toggle'));
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        });
    });
</script>
<!-- SIGN UP FORM CREATION -->
<script src="{{ asset('login/js/login_admin.js') }}"></script>
</body>

</html>
