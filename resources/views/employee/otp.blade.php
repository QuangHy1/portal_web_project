@extends('Frontend.layouts.master')
@section('page_title')OTP Employee Password @endsection
@section('body_content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employee.signin') }}">Đăng Nhập</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Khôi Phục Mật Khẩu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Top Breadcrubms ======================== -->

    <!-- ======================= Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center mb-5">
                        <h6 class="text-muted mb-0">Bước 2</h6>
                        <h2 class="ft-bold">Nhập mã xác thực (OTP)</h2>
                        <p class="text-muted mt-2">
                            Chúng tôi đã gửi một mã OTP gồm 6 số đến email
                            <strong>{{ session('recovery_email') }}</strong>.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('employee.otp.verify') }}" class="border p-3 rounded text-center">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('recovery_email') }}">

                        @if (session()->get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session()->get('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-4 otp-inputs">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" name="otp_code[]" maxlength="1" class="form-control text-center mx-1 otp-box" required pattern="[0-9]">
                            @endfor
                        </div>

                        <button type="submit" class="btn btn-md full-width theme-bg text-light fs-md ft-medium">Xác Nhận Mã OTP</button>

                        <div class="mt-3">
                            <a href="{{ route('employee.recover') }}">← Gửi lại mã</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        .otp-box {
            width: 45px;
            height: 50px;
            font-size: 22px;
            font-weight: bold;
        }
    </style>

    <script>
        // Tự động di chuyển con trỏ khi nhập xong 1 số
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.otp-box');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
            });
        });
    </script>

    <!-- ======================= End ======================== -->

    <!-- ======================= Newsletter Start ============================ -->
    <section class="space bg-cover" style="background:#03343b url(assets/img/landing-bg.png) no-repeat;">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center mb-5">
                        <h6 class="text-light mb-0">Đăng Ký Ngay (Subcribe Now)</h6>
                        <h2 class="ft-bold text-light">Nhận Tất Cả Thông Tin Về Việc Làm Mới Nhất</h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12 col-12">
                    <form class="bg-white rounded p-1">
                        <div class="row no-gutters">
                            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
                                <div class="form-group mb-0 position-relative">
                                    <input type="text" class="form-control lg left-ico" placeholder="Điền Email của bạn tại đây...">
                                    <i class="bnc-ico lni lni-envelope"></i>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                                <div class="form-group mb-0 position-relative">
                                    <button class="btn full-width custom-height-lg theme-bg text-light fs-md" type="button">Click</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
