@extends('Frontend.layouts.master')
@section('page_title')Job Application @endsection
@section('body_content')
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ứng Tuyển Công Việc</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Contact Page Detail ======================== -->
<section class="middle">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Ứng Tuyển Công Việc</h2>
                </div>
            </div>
        </div>
        <div class="bg-light rounded px-3 py-4 mb-4">
            <div class="jbd-01 d-flex align-items-center justify-content-between">
                <div class="jbd-flex d-flex align-items-center justify-content-start">
                    <div class="jbd-01-thumb">
                        <img src="{{ asset('uploads/companies').'/'. $jobDetails->company->logo }}" class="img-fluid" width="90" alt="" />
                    </div>
                    <div class="jbd-01-caption pl-3">
                        <div class="tbd-title"><h4 class="mb-0 ft-medium fs-md">{{ $jobDetails->title }}</h4></div>
                        <div class="jbl_location mb-3"><span><i class="lni lni-map-marker mr-1"></i>{{ $jobDetails->company->name }}</span><span class="medium ft-medium text-warning ml-3">{{ $jobDetails->jobType->name }}</span></div>
                        <div class="jbl_info01">
                            @php
                            $tags = $jobDetails->tags;
                            $tag_array = explode(',', $tags);
                            @endphp
                                @foreach($tag_array as $tag)
                                <span class="px-2 py-1 ft-medium medium rounded text-purple bg-light-purple">{{ $tag }}</span>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="jbd-01-right text-right hide-1023">
                    <div class="jbl_button"><a href="{{ route('jobs', $jobDetails->id) }}" class="btn rounded bg-white border fs-sm ft-medium">Xem chi tiết</a></div>
                </div>
            </div>
        </div>
        <div class="row align-items-center d-flex justify-content-between">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <form class="row" method="POST" action="{{ route('employee.apply.confirm', $jobDetails->id) }}">
                    @csrf
                    <input type="hidden" name="hiring_id" value="{{ $jobDetails->id }}">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Họ và Tên*</label>
                            <span tabindex="0" data-toggle="tooltip" title="Để thay đổi Họ và Tên của bạn, vui lòng cập nhật lại profile.">
                                @if(isset($employee))
                                    <input disabled type="text" class="form-control" value="{{ $employee->firstname . ' ' . $employee->lastname }}">
                                @else
                                    <input disabled type="text" class="form-control" value="Chưa có thông tin nhân viên">
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Email*</label>
                            <span tabindex="0" data-toggle="tooltip" title="Để thay đổi email của bạn, vui lòng cập nhật lại profile.">
                                @if(isset($employeeUser))
                                    <input disabled type="text" class="form-control" value="{{ $employeeUser->email }}">
                                @else
                                    <input disabled type="text" class="form-control" value="Không có email">
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Chọn CV để gửi kèm*</label>
                            <select name="resume_id" class="form-control" required>
                                <option value="">-- Chọn CV --</option>
                                @foreach($resumes as $resume)
                                    <option value="{{ $resume->id }}">{{ $resume->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="small text-dark ft-medium">Lời nhắn*</label>
                            <textarea name="cover_letter" class="form-control ht-80"></textarea>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            @if($applicationCheck > 0)
                            <span tabindex="0" data-toggle="tooltip" title="Your job application has been already received. Please await confirmation from the company.">
                            <button type="submit" disabled class="btn btn-dark">Apply</button>
                            </span>
                            @else
                            <button type="submit" class="btn btn-dark">Apply</button>
                            @endif
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Contact Page End ======================== -->

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
