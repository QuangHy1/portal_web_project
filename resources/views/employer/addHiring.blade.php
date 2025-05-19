@extends('Frontend.layouts.masterDashboard')
@section('page_title')Add Hiring Post @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Thêm mới Tin Tuyển Dụng</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="theme-cl">Đăng Tin</a></li>
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
                                <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-file mr-1 theme-cl fs-sm"></i>Đăng Tin Tuyển Dụng</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="post" action="{{ route('employer.hiring.add') }}">
                                @csrf
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="row">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endforeach
                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tiêu Đề*</label>
                                                <input type="text" name="title" class="form-control rounded  @error('title') is-invalid @enderror" placeholder="Title">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Mô Tả*</label>
                                                <textarea class="form-control rounded  @error('description') is-invalid @enderror" name="description" placeholder="Job Description"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Ngành Nghề*</label>
                                                <select name="category" class="form-control rounded @error('category') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($JobCategory as $item)
                                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Vị trí*</label>
                                                <select name="location" class="form-control rounded @error('location') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($Location as $item)
                                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Hình Thức Làm Việc*</label>
                                                <select name="type" class="form-control rounded @error('type') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($JobType as $item)
                                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Mức Lương*</label>
                                                <select name="salary" class="form-control rounded @error('salary') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($SalaryRange as $item)
                                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Kinh Nghiệm*</label>
                                                <select name="experience" class="form-control rounded @error('experience') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($Experience as $item)
                                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Trình Độ*</label>
                                                <select name="education" class="form-control rounded @error('education') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    <option value="Đại Học">Đại Học</option>
                                                    <option value="Thạc sĩ, Đại học">Thạc sĩ, Đại học</option>
                                                    <option value="Trung Cấp">Trung Cấp</option>
                                                    <option value="Tốt nghiệp THPT">Tốt nghiệp THPT</option>
                                                    <option value="Cao Đẳng">Cao Đẳng</option>
                                                    <option value="Không">Không</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Giới Tính Yêu Cầu*</label>
                                                <select name="gender" class="form-control rounded">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                    <option value="Không yêu cầu (All gender)">Không yêu cầu (All gender)</option>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark ft-medium">Số Lượng Cần Tuyển*</label>
                                                    <select name="vacancy_id" class="form-control rounded" required>
                                                        <option value="">-- Chọn số lượng --</option>
                                                        @foreach($vacancies as $vacancy)
                                                            <option value="{{ $vacancy->id }}"
                                                                {{ old('vacancy_id', isset($hiring) ? $hiring->vacancy_id : '') == $vacancy->id ? 'selected' : '' }}>
                                                                {{ $vacancy->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Thời Gian Ứng Tuyển*</label>
                                                <input type="date" name="deadline" class="form-control rounded" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tags</label>
                                                <input type="text" name="tags" class="form-control rounded" data-role="tagsinput" placeholder="WordPress, HTML, PHP">
                                                <sub>Vui lòng thêm các tags cách nhau bởi dấu phẩy, ví dụ: WordPress, HTML, PHP. </sub>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Trạng Thái Tin*</label>
                                                <select name="status" class="form-control rounded" disabled>
                                                    <option value="active">Đang tuyển</option>
                                                    <option value="inactive">Hết tuyển</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" name="token" value="{{ uniqid() }}">
                                                <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Đăng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
