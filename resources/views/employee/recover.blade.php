@extends('Frontend.layouts.master')
@section('page_title')Recover Employee Password @endsection
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
                    <h6 class="text-muted mb-0">Quên Mật Khẩu</h6>
                    <h2 class="ft-bold">Đặt lại mật khẩu</h2>
                </div>
                <form class="border p-3 rounded" method="POST" action="{{ route('employee.recover.submit') }}">
                    @if (session()->get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-2"> </i> {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-2"> </i> {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @csrf
                    <div class="form-group has-validation">
                        <label>Email của bạn: </label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập địa chỉ email của bạn">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md full-width theme-bg text-light fs-md ft-medium">Gửi mã OTP</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <p>Bạn đã nhớ mật khẩu? <a href="{{ route('employee.signin') }}">Đăng Nhập Ngay</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
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
