@extends('Frontend.layouts.master')
@section('page_title')Xác Minh Email Thành Công(Employer)@endsection
@section('body_content')

<section class="middle">
    <div class="container">
        <div class="row align-items-start justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <form class="border p-3 rounded">
                    <img class="mx-auto d-block" style="max-width:200px;" src="{{ asset('frontEndAssets/img/verify.svg') }}">
                    <div class="sec_title position-relative text-center mt-4 mb-5">
                        <h2 class="ft-bold">Email Của Bạn Đã Được Xác Minh</h2>
                        <h6 class="text-muted mt-3 mb-0">
                            Chúc mừng! Email của bạn đã được xác minh thành công. <br>
                            Bây giờ bạn có thể đăng nhập và bắt đầu đăng tuyển công việc phù hợp ngay hôm nay.
                        </h6>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('employer.signin') }}" class="btn btn-md full-width theme-bg text-light fs-md ft-medium">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng Nhập Ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Login End ======================== -->

<!-- ======================= Newsletter Start ============================ -->
<section class="space bg-cover" style="background:#03343b url({{ asset('frontEndAssets/img/landing-bg.png') }}) no-repeat;">
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
