@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employeeDashboardNav')

    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Change Password</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="theme-cl">Đổi Mật Khẩu</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="dashboard-widg-bar d-block">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="_dashboard_content bg-white rounded mb-4">
                        <div class="_dashboard_content_header br-bottom py-3 px-3">
                            <div class="_dashboard__header_flex">
                                <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-lock mr-1 theme-cl fs-sm"></i>Đổi Mật Khẩu</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            {{-- Thông báo thành công --}}
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            {{-- Thông báo lỗi --}}
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            {{-- Thông báo lỗi từ validate --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="row" method="post" action="{{ route('employee.password.change.confirm') }}">
                                @csrf

                                <!-- Mật khẩu hiện tại -->
                                <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                    <div class="form-group position-relative">
                                        <label class="text-dark ft-medium">Mật khẩu hiện tại</label>
                                        <input type="password" name="oldpassword" id="oldpassword" class="form-control rounded pr-5">
                                        <span class="toggle-password" toggle="#oldpassword" style="position:absolute; top:38px; right:15px; cursor:pointer;">👁️</span>
                                    </div>
                                </div>

                                <!-- Mật khẩu mới -->
                                <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                    <div class="form-group position-relative">
                                        <label class="text-dark ft-medium">Mật khẩu mới</label>
                                        <input type="password" name="newpassword" id="newpassword" class="form-control rounded pr-5">
                                        <span class="toggle-password" toggle="#newpassword" style="position:absolute; top:38px; right:15px; cursor:pointer;">👁️</span>
                                    </div>
                                </div>

                                <!-- Xác nhận mật khẩu -->
                                <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                    <div class="form-group position-relative">
                                        <label class="text-dark ft-medium">Xác nhận lại mật khẩu</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control rounded pr-5">
                                        <span class="toggle-password" toggle="#confirmpassword" style="position:absolute; top:38px; right:15px; cursor:pointer;">👁️</span>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div> {{-- end content body --}}
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelectorAll('.toggle-password').forEach(item => {
                item.addEventListener('click', function () {
                    const input = document.querySelector(this.getAttribute('toggle'));
                    if (input.getAttribute('type') === 'password') {
                        input.setAttribute('type', 'text');
                        this.textContent = '🙈';
                    } else {
                        input.setAttribute('type', 'password');
                        this.textContent = '👁️';
                    }
                });
            });
        </script>
@endsection
