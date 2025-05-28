@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
@include('Frontend.layouts.employeeDashboardNav')
<div class="dashboard-content">
    <div class="dashboard-tlbar d-block mb-5">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <h1 class="ft-medium">My Profile</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" class="theme-cl">Hồ Sơ</a></li>
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
                            <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-user mr-1 theme-cl fs-sm"></i>Hồ Sơ Của Tôi</h4>
                        </div>
                    </div>

                    <div class="_dashboard_content_body py-3 px-3">
                        <form class="row" method="post" action="{{ route('employee.profile.edit') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                {{-- Upload Ảnh --}}
                                <div class="custom-file avater_uploads text-center">
                                    <label for="file-input" class="btn btn-primary mb-2">Chọn ảnh</label>
                                    <input type="file" name="photo" id="file-input" onchange="previewImage();" style="display: none;">
                                    @php
                                        $photo = Auth::guard('employee')->user()->employee->photo ?? null;
                                    @endphp

                                    <img
                                        id="image-preview"
                                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;"
                                        src="{{ $photo ? asset($photo) : 'https://icon-library.com/images/no-user-image-icon/no-user-image-icon-3.jpg' }}"
                                        alt="employee photo"
                                    />
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                <div class="row">
                                    {{-- Basic Info --}}
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Họ*</label>
                                        <input type="text" class="form-control rounded" name="firstname" value="{{ $employee->firstname }}" required>
                                    </div>
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Tên*</label>
                                        <input type="text" class="form-control rounded" name="lastname" value="{{ $employee->lastname }}" required>
                                    </div>

                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Số điện thoại</label>
                                        <input type="text" class="form-control rounded" name="phone" value="{{ $employee->phone }}">
                                    </div>
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Email</label>
                                        <input type="text" class="form-control rounded" name="email" value="{{ $employee->user->email }}" readonly>
                                    </div>

                                    {{-- Địa chỉ & giới tính --}}
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Địa chỉ</label>
                                        <input type="text" class="form-control rounded" name="address" value="{{ $employee->address }}">
                                    </div>
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Giới tính</label>
                                        <select name="gender" class="custom-select rounded">
                                            <option value="">Chọn giới tính</option>
                                            <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Nam</option>
                                            <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                                            <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>

                                    {{-- Ngày sinh --}}
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Ngày sinh</label>
                                        <input type="date" class="form-control rounded" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                                    </div>

                                    {{-- Chức danh & Địa điểm (nếu dùng location_id) --}}
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Chức danh (Designation)</label>
                                        <input type="text" class="form-control rounded" name="designation" value="{{ $employee->designation }}">
                                    </div>
                                    <div class="col-xl-6"><label class="text-dark ft-medium" style="margin-top: 10px">Địa điểm (Location)</label>
                                        <select name="location_id" class="custom-select rounded">
                                            <option value="">Chọn địa điểm</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ $employee->location_id == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Giới thiệu bản thân --}}
                                    <div class="col-xl-12">
                                        <label class="text-dark ft-medium" style="margin-top: 10px">Giới thiệu bản thân</label>
                                        <textarea name="bio" class="form-control with-light">{{ old('bio', $employee->bio) }}</textarea>
                                    </div>

                                    {{-- Nút lưu --}}
                                    <div class="col-xl-12">
                                        <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg mt-3">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="_dashboard_content bg-white rounded mb-4">
                    <div class="_dashboard_content_header br-bottom py-3 px-3">
                        <div class="_dashboard__header_flex">
                            <h4 class="mb-0 ft-medium fs-md"><i class="ti-facebook mr-1 theme-cl fs-sm"></i>Liên Kết Xã Hội Khác</h4>
                        </div>
                    </div>

                    <div class="_dashboard_content_body py-3 px-3">
                        <form class="row" method="post" action="{{ route('employee.profile.social.edit') }}">
                            @csrf

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark ft-medium" style="margin-top: 10px">Website</label>
                                    <input type="url" name="website" class="form-control rounded" placeholder="https://www.yoursite.com" value="{{ old('website', $employee->website) }}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark ft-medium" style="margin-top: 10px">Facebook</label>
                                    <input type="url" name="facebook" class="form-control rounded" placeholder="https://www.facebook.com/" value="{{ old('facebook', $employee->facebook) }}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark ft-medium" style="margin-top: 10px">Instagram</label>
                                    <input type="url" name="instagram" class="form-control rounded" placeholder="https://www.instagram.com/" value="{{ old('instagram', $employee->instagram) }}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark ft-medium" style="margin-top: 10px">GitHub</label>
                                    <input type="url" name="github" class="form-control rounded" placeholder="https://www.github.com/" value="{{ old('github', $employee->github) }}">
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            var preview = document.querySelector('#image-preview');
            var file = document.querySelector('#file-input').files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>

@endsection
