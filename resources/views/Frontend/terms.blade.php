@extends('Frontend.layouts.master')
@section('page_title')Terms & Policies @endsection
@section('body_content')
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chính Sách Bảo Mật</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= About Us Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row align-items-center justify-content-between">

            <div class="col-xl-11 col-lg-12 col-md-6 col-sm-12">
                <div class="abt_caption">
                    <h2 class="ft-medium mb-4">Chính sách & Quyền riêng tư</h2>
                    <p class="mb-4">Chúng tôi cam kết bảo vệ thông tin cá nhân của người dùng và chỉ sử dụng dữ liệu cho mục đích tuyển dụng hợp pháp.</p>
                    <p class="mb-4">Bằng cách sử dụng website này, bạn đồng ý với các điều khoản về thu thập, lưu trữ và xử lý dữ liệu theo chính sách bảo mật của chúng tôi.</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= About Us End ======================== -->

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
<!-- ======================= Newsletter Start ============================ -->
@endsection
