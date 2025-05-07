@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
<div class="dashboard-content">
    <div class="dashboard-tlbar d-block mb-5">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <h1 class="ft-medium">Tất Cả Các Ứng Viên</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employer.hiring.list') }}">Quản Lý Tin</a></li>
                        <li class="breadcrumb-item "><a href="#" class="theme-cl">Quản Lý Apply</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Hiển thị Tiêu đề Hiring -->
    @if($applications->count() > 0)
        <h2 class="ft-medium">{{ $applications->first()->hiring->title }}</h2>
    @else
        <p>Không có ứng viên nào đã apply vào công việc này.</p>
    @endif

    <div class="dashboard-widg-bar d-block">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="px-3 py-2 br-bottom br-top bg-white rounded mb-3">
                    <div class="flixors">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                <h6 class="mb-0 ft-medium fs-sm">{{ $applications->count() }} Tổng Số Ứng Viên Đã Apply </h6>
                            </div>
                            <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                <div class="filter_wraps elspo_wrap d-flex align-items-center justify-content-end">
                                    <div class="single_fitres mr-2">
                                        <select class="custom-select simple">
                                          <option value="1" selected="">Mặc định</option>
                                          <option value="2">Xếp theo Tên</option>
                                          <option value="3">Xếp theo Đánh giá</option>
                                          <option value="4">Xếp theo Xu Hướng</option>
                                          <option value="5">Xếp theo Mới Nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if($applications->isEmpty())
                    <p>Không có ứng viên nào đã apply vào công việc này.</p>
                @else
                    @foreach($applications as $application)
                        <!-- Hiển thị thông tin ứng viên ở đây -->
                    @endforeach
                @endif

                <div class="data-responsive">
                    @foreach($applications as $application)
                    <!-- Single List -->
                    <div class="dashed-list-wrap bg-white rounded mb-3">
                        <div class="dashed-list-full bg-white rounded p-3 mb-3">
                            <div class="dashed-list-short d-flex align-items-center">
                                <div class="dashed-list-short-first">
                                    <div class="dashed-avater">
                                        <img src="{{ asset($application->employee->photo) }}" class="img-fluid circle" width="70" alt="Ảnh ứng viên" />
                                    </div>
                                </div>
                                <div class="dashed-list-short-last">
                                    <div class="cats-box-caption px-2">
                                        <h4 class="fs-lg mb-0 ft-medium theme-cl">{{ $application->employee->firstname }} {{ $application->employee->lastname }}</h4>
                                        <div class="d-block mb-2 position-relative">
                                            @if( $application->employee->address == null)
                                            <span><i class="lni lni-map-marker mr-1"></i>Chưa được thêm</span>
                                            @else
                                            <span><i class="lni lni-map-marker mr-1"></i>{{ $application->employee->address }}</span>
                                            @endif
                                            @if( $application->employee->designation == null)
                                            <span class="ml-2"><i class="lni lni-briefcase mr-1"></i>Chưa được thêm</span>
                                            @else
                                            <span class="ml-2"><i class="lni lni-briefcase mr-1"></i>{{ $application->employee->designation }}</span>
                                            @endif
                                        </div>
                                        <div class="ico-content">
                                            <ul>
                                                <li><a href="{{ route('employer.applications.viewCV', $application->id) }}" class="btn btn-sm btn-info" target="_blank">
                                                        Xem CV
                                                    </a></li>
                                                {{-- <li><button class="px-2 py-1 medium bg-light-info rounded text-info" style="border:none;"><i class="lni lni-envelope mr-1"></i>Message</button></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dashed-list-last">
                                <div class="text-left">
                                    <a href="#" data-toggle="modal" data-target="#details{{ $application->id }}" class="btn gray ft-medium apply-btn fs-sm rounded mr-1"><i class="lni lni-arrow-right-circle mr-1"></i>Chi Tiết</a>
                                    <a href="#" data-toggle="modal" data-target="#cover{{ $application->id }}" class="btn gray ft-medium apply-btn fs-sm rounded mr-1">
                                        <i class="lni lni-add-files mr-1"></i>Xem Lời Nhắn
                                    </a>
                                    <a href="{{ route('employer.hiring.applicant.approve', $application->id) }}" class="btn gray ft-medium apply-btn fs-sm rounded"><i class="lni lni-heart mr-1"></i>Duyệt</a>
                                    <a href="{{ route('employer.hiring.applicant.reject', $application->id) }}" class="btn gray ft-medium apply-btn fs-sm rounded"><i class="lni lni-trash-can mr-1"></i>Từ Chối</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashed-list-footer p-3 br-top">
                            <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="ico-content">
                                <ul>
                                    <li>
                                        <span>
                                            <i class="lni lni-calendar mr-1"></i>
                                            {{ date('d-m-Y', strtotime($application->created_at)) }}
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            <i class="lni lni-add-files mr-1"></i>
                                            @if ($application->status === 'approved')
                                                Đã Duyệt
                                            @elseif ($application->status === 'rejected')
                                                Từ Chối
                                            @else
                                                {{ $application->status }}
                                            @endif
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                   @endforeach

                </div>
            </div>
        </div>
    </div>

    @endsection
