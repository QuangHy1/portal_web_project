@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
    <style>
        .field-icon {
            position: absolute;
            top: 38px;
            right: 15px;
            cursor: pointer;
            color: #aaa;
            z-index: 100;
        }
    </style>
<div class="dashboard-content">
	<div class="dashboard-tlbar d-block mb-5">
		<div class="row">
			<div class="colxl-12 col-lg-12 col-md-12">
				<h1 class="ft-medium">Đổi Mật Khẩu</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
						<li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
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
							<h4 class="mb-0 ft-medium fs-md"><i class="fa fa-lock mr-1 theme-cl fs-sm"></i>Đổi mật khẩu</h4>
						</div>
					</div>

					<div class="_dashboard_content_body py-3 px-3">
						<form class="row" method="post" action="{{ route('employer.password.change.confirm') }}">
							@csrf
							<div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <label class="text-dark ft-medium">Mật khẩu hiện tại</label>
                                    <input type="password" name="oldpassword" class="form-control rounded password-field" placeholder="">
                                    <span toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
							<div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <label class="text-dark ft-medium">Mật khẩu mới</label>
                                    <input type="password" name="newpassword" class="form-control rounded password-field" placeholder="">
                                    <span toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
							</div>
							<div class="col-xl-8 col-lg-9 col-md-12 col-sm-12">
                                <div class="form-group position-relative">
                                    <label class="text-dark ft-medium">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="confirmpassword" class="form-control rounded password-field" placeholder="">
                                    <span toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
							</div>
							<div class="col-xl-12 col-lg-12">
								<div class="form-group">
									<button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu Thay Đổi</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(el) {
            el.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.getAttribute('type') === 'password') {
                    input.setAttribute('type', 'text');
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.setAttribute('type', 'password');
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
