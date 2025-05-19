@extends('Frontend.layouts.masterDashboard')
@section('page_title')Edit Company Profile @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Hồ Sơ Cá Nhân </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
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
                                <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-user mr-1 theme-cl fs-sm"></i>Tài khoản</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="POST" action="{{ route('employer.profile.edit') }}" enctype="multipart/form-data">
                                @csrf

                                {{-- Logo công ty --}}
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <label class="text-dark ft-medium">Logo Công Ty </label>
                                    <div class="custom-file avater_uploads">
                                        <input type="file" class="custom-file-input" id="customFile" name="logo">
                                        <img class="custom-file-label"
                                             style="width: 200px; height: 200px;"
                                             src="{{ asset('uploads/companies/' . optional(Auth::guard('employer')->user()->employer->company)->logo) }}"
                                             alt="Company Logo">
                                    </div>
                                </div>

                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                    <div class="row">
                                        {{-- Họ và tên --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Họ*</label>
                                                <input type="text" name="firstname" class="form-control rounded @error('firstname') is-invalid @enderror" value="{{ old('firstname', Auth::guard('employer')->user()->employer->firstname) }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tên*</label>
                                                <input type="text" name="lastname" class="form-control rounded @error('lastname') is-invalid @enderror" value="{{ old('lastname', Auth::guard('employer')->user()->employer->lastname) }}">
                                            </div>
                                        </div>

                                        {{-- Giới tính --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Giới Tính</label>
                                                <select name="gender" class="custom-select rounded @error('gender') is-invalid @enderror">
                                                    <option value="Nam" {{ optional(Auth::guard('employer')->user()->employer)->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                                    <option value="Nữ" {{ optional(Auth::guard('employer')->user()->employer)->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                                    <option value="Khác" {{ optional(Auth::guard('employer')->user()->employer)->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Ngày sinh --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Ngày Sinh</label>
                                                <input type="date" name="date_of_birth" class="form-control rounded @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', Auth::guard('employer')->user()->employer->date_of_birth) }}">
                                            </div>
                                        </div>

                                        {{-- Tên công ty --}}
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tên Doanh Nghiệp/Công Ty*</label>
                                                <input type="text" name="company_name" class="form-control rounded @error('company_name') is-invalid @enderror" value="{{ old('company_name', optional(Auth::guard('employer')->user()->employer->company)->name) }}">
                                            </div>
                                        </div>

                                        {{-- Username và Email (readonly) --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tên Tài Khoản(Username)*</label>
                                                <input type="text" disabled class="form-control rounded" value="{{ Auth::guard('employer')->user()->username }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Email*</label>
                                                <input type="email" disabled class="form-control rounded" value="{{ Auth::guard('employer')->user()->email }}">
                                            </div>
                                        </div>

                                        {{-- Số điện thoại --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Số điện thoại</label>
                                                <input type="number" name="phone" class="form-control rounded @error('phone') is-invalid @enderror" value="{{ old('phone', Auth::guard('employer')->user()->employer->phone) }}">
                                            </div>
                                        </div>

                                        {{-- Địa chỉ chi tiết --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Địa chỉ</label>
                                                <input type="text" name="address" class="form-control rounded @error('address') is-invalid @enderror" value="{{ old('address', Auth::guard('employer')->user()->employer->address) }}">
                                            </div>
                                        </div>

                                        {{-- Khu vực --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Trụ Sở Công Ty</label>
                                                <input type="text" name="company_location"
                                                       class="form-control rounded @error('company_location') is-invalid @enderror"
                                                       value="{{ optional(Auth::guard('employer')->user()->employer->company)->location }}"
                                                       placeholder="Enter Primary Location">
                                                @error('company_location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Ngành nghề --}}
                                        <div class="col-xl-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Lĩnh Vực</label>
                                                <select name="industry_id" class="custom-select rounded @error('industry_id') is-invalid @enderror" data-live-search="true">
                                                    <option value="">Select Company Industry</option>
                                                    @foreach($industries as $ind)
                                                        <option value="{{ $ind->id }}" {{ Auth::guard('employer')->user()->employer->industry_id == $ind->id ? 'selected' : '' }}>{{ $ind->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Giới thiệu --}}
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Thông Tin Về Tôi</label>
                                                <textarea name="about" class="form-control with-light @error('about') is-invalid @enderror">{{ old('about', Auth::guard('employer')->user()->employer->about) }}</textarea>
                                            </div>
                                        </div>

                                        {{-- Nút lưu --}}
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu</button>
                                            </div>
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
                                <h4 class="mb-0 ft-medium fs-md"><i class="ti-time mr-1 theme-cl fs-sm"></i>Giờ Làm Việc</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="post" action="{{ route('employer.profile.openinghour.edit') }}">
                                @csrf
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 2</label>
                                        <input type="text" name="monday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_monday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 3</label>
                                        <input type="text" name="tuesday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_tuesday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 4</label>
                                        <input type="text" name="wednesday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_wednesday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 5</label>
                                        <input type="text" name="thursday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_thursday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 6</label>
                                        <input type="text" name="friday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_friday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Thứ 7</label>
                                        <input type="text" name="saturday" class="form-control rounded" placeholder="Closed" value="{{ Auth::guard('employer')->user()->employer->hours_saturday }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Chủ Nhật</label>
                                        <input type="text" name="sunday" class="form-control rounded" placeholder="10 AM - 6 PM" value="{{ Auth::guard('employer')->user()->employer->hours_sunday }}">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="_dashboard_content bg-white rounded mb-4">
                        <div class="_dashboard_content_header br-bottom py-3 px-3">
                            <div class="_dashboard__header_flex">
                                <h4 class="mb-0 ft-medium fs-md"><i class="ti-facebook mr-1 theme-cl fs-sm"></i>Liên Kết Xã Hội</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="post" action="{{ route('employer.profile.sociallink.edit') }}">
                                @csrf
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Facebook</label>
                                        <input type="text" name="facebook" class="form-control rounded" placeholder="https://www.facebook.com/" value="{{ Auth::guard('employer')->user()->employer->facebook }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Instagram</label>
                                        <input type="text" name="instagram" class="form-control rounded" placeholder="https://www.instagram.com/" value="{{ Auth::guard('employer')->user()->employer->instagram }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Github</label>
                                        <input type="text" name="github" class="form-control rounded" placeholder="https://www.github.com/" value="{{ Auth::guard('employer')->user()->employer->github }}">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="_dashboard_content bg-white rounded mb-4">
                        <div class="_dashboard_content_header br-bottom py-3 px-3">
                            <div class="_dashboard__header_flex">
                                <h4 class="mb-0 ft-medium fs-md">
                                    <i class="fas fa-lock mr-1 theme-cl fs-sm"></i>Thông Tin Liên Hệ
                                </h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="post" action="{{ route('employer.profile.contact.edit') }}">
                                @csrf

                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Số Điện Thoại*</label>
                                        <input type="text" name="phone" class="form-control rounded @error('phone') is-invalid @enderror"
                                               value="{{ Auth::guard('employer')->user()->employer->phone }}" >
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Vị Trí*</label>
                                        <select name="location_id" class="custom-select rounded @error('location_id') is-invalid @enderror" >
                                            <option value="">Chọn</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}"
                                                        @if(Auth::guard('employer')->user()->employer->location_id == $location->id) selected @endif>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark ft-medium">Địa Chỉ*</label>
                                        <input type="text" name="address" class="form-control rounded @error('address') is-invalid @enderror"
                                               value="{{ Auth::guard('employer')->user()->employer->address }}" >
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="{{ asset('frontEndAssets/js/nepaladdress.js') }}"></script>
@endsection
