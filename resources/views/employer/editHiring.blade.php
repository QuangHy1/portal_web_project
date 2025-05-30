@extends('Frontend.layouts.masterDashboard')
@section('page_title')Edit Hiring Post @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Chỉnh sửa Tin</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="theme-cl">Chỉnh sửa Tin</a></li>
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
                                <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-file mr-1 theme-cl fs-sm"></i>Chỉnh sư Tin Tuyển Dụng</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                            <form class="row" method="post" action="{{ route('employer.hiring.update', $hiring->id) }}">
                                @csrf
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="row">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endforeach
                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tiêu Đề*</label>
                                                <input type="text" name="title" class="form-control rounded  @error('title') is-invalid @enderror" placeholder="Title" value="{{ $hiring->title }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Mô Tả*</label>
                                                <textarea class="form-control rounded  @error('description') is-invalid @enderror" name="description" placeholder="Job Description">{{ $hiring->description }}</textarea>
                                            </div>
                                        </div>

{{--                                        <div class="col-xl-12 col-lg-12 col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="text-dark ft-medium">Job Requirements*</label>--}}
{{--                                                @foreach($hiring->requirement as $requirement)--}}
{{--                                                    <div class="dynamic-wraps">--}}
{{--                                                        <div class="entry input-group">--}}
{{--                                                            <input disabled class="form-control mb-2   @error('fieldsUpdate[]') is-invalid @enderror" name="fieldsUpdate[]" type="text" placeholder="Type something"  value="{{ $requirement->requirements }}"/>--}}
{{--                                                            <span class="input-group-btn">--}}
{{--                                                          <a href="{{ route('employer.requirement.delete', $requirement->id, $hiring->id) }}" class="btn btn-danger mb-2" style="padding: 15px;">--}}
{{--                                                                  <span class="lni lni-trash-can"></span>--}}
{{--                                                          </a>--}}
{{--                                                        </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                                <div class="dynamic-wrap">--}}
{{--                                                    <div class="entry input-group">--}}
{{--                                                        <input class="form-control mb-2  @error('fields[]') is-invalid @enderror" name="fields[]" type="text" placeholder="Type something" />--}}
{{--                                                        <span class="input-group-btn">--}}
{{--                                                          <button class="btn btn-success btn-add mb-2" style="padding: 15px;" type="button">--}}
{{--                                                                  <span class="lni lni-plus"></span>--}}
{{--                                                          </button>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Ngành Nghề*</label>
                                                <select name="category" class="form-control rounded @error('category') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach ($JobCategory as $item)
                                                        <option @if($hiring->job_category_id == $item->id) selected @endif value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Vị Trí*</label>
                                                <select name="location" class="form-control">
                                                    @foreach($Location as $loc)
                                                        <option value="{{ $loc->id }}" {{ $hiring->location_id == $loc->id ? 'selected' : '' }}>
                                                            {{ $loc->name }}
                                                        </option>
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
                                                        <option @if($hiring->job_type_id  == $item->id) selected @endif value="{{ $item->id }}">{{$item->name}}</option>
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
                                                        <option @if($hiring->salary_range_id  == $item->id) selected @endif value="{{ $item->id }}">{{$item->name}}</option>
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
                                                        <option @if($hiring->experience_id  == $item->id) selected @endif value="{{ $item->id }}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Trình Độ*</label>
                                                <p>Giá trị hiện tại: {{ old('education', $hiring->education) }}</p>
                                                <select name="education" class="form-control rounded @error('education') is-invalid @enderror">
                                                    <option value="">Chọn</option>
                                                    @foreach(['Đại học', 'Thạc sĩ, Đại học', 'Trung Cấp', 'Tốt nghiệp THPT', 'Cao Đẳng', 'Không'] as $option)
                                                        <option value="{{ $option }}" {{ old('education', $hiring->education) == $option ? 'selected' : '' }}>
                                                            {{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Giới Tính Yêu Cầu*</label>
                                                <select name="gender" class="form-control rounded">
                                                    <option @if($hiring->gender == "Nam") selected @endif value="Nam">Nam</option>
                                                    <option @if($hiring->gender == "Nữ") selected @endif value="Nữ">Nữ</option>
                                                    <option @if($hiring->gender == "Không yêu cầu (All gender)") selected @endif value="Không yêu cầu (All gender)">Không yêu cầu (All gender)</option>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark ft-medium">Số Lượng Cần Tuyển*</label>
                                                    <select name="vacancy_id" class="form-control rounded" required>
                                                        <option value="">-- Chọn số lượng --</option>
                                                        @foreach($vacancies as $vacancy)
                                                            <option value="{{ $vacancy->id }}" {{ (old('vacancy_id', $hiring->vacancy_id) == $vacancy->id) ? 'selected' : '' }}>
                                                                {{ $vacancy->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Thời Hạn Ứng Tuyển*</label>
                                                <input type="date" name="deadline" class="form-control rounded" value="{{ $hiring->deadline }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Tags</label>
                                                <input type="text" name="tags" class="form-control rounded" data-role="tagsinput" placeholder="WordPress, Joomla, PHP" value="{{ $hiring->tags }}">
                                                <sub>Vui lòng thêm các tags cách nhau bởi dấu phẩy, ví dụ: WordPress, HTML, PHP.</sub>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark ft-medium">Trạng Thái Tin*</label>
                                                <select name="status" class="form-control rounded">
                                                    <option @if($hiring->status == "active") selected @endif value="active">Đang tuyển</option>
                                                    <option @if($hiring->status == "inactive") selected @endif value="inactive">Hết tuyển</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" name="token" value="{{ $hiring->token }}">
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
