@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
@include('Frontend.layouts.employeeDashboardNav')
<div class="dashboard-content">
    <div class="dashboard-tlbar d-block mb-5">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <h1 class="ft-medium">Tin Đã Lưu</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" class="theme-cl">Tin Đã Lưu</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="dashboard-widg-bar d-block">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="cl-justify">

                    <div class="cl-justify-first">
                        <p class="m-0 p-0 ft-sm">Bạn đã lưu <span class="text-dark ft-medium">{{ $bookmarks->count() }}</span> công việc.</p>
                    </div>

                    <div class="cl-justify-last">
                        <div class="d-flex align-items-center justify-content-left">
                            <div class="dlc-list">
                                <form method="GET" id="filterForm">
                                    <select name="job_type" class="form-control sm rounded" onchange="document.getElementById('filterForm').submit();">
                                        <option value="">Tất cả loại công việc</option>
                                        @foreach($jobTypes as $type)
                                            <option value="{{ $type }}" {{ request('job_type') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="per_page" class="form-control sm rounded mt-2" onchange="document.getElementById('filterForm').submit();">
                                        @foreach($perPageOptions as $option)
                                            <option value="{{ $option }}" {{ request('per_page', 20) == $option ? 'selected' : '' }}>
                                                Hiển thị {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="mb-4 tbl-lg rounded overflow-hidden">
                    <div class="table-responsive bg-white">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Tiêu Đề</th>
                                  <th scope="col">Status</th>
                                    <th scope="col">Hạn Apply</th>
                                  <th scope="col">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookmarks as $bookmark)
                                <tr>
                                    <td>
                                        <div class="cats-box rounded bg-white d-flex align-items-center">
                                            <div class="text-center">
                                                @if($bookmark->hiring && $bookmark->hiring->company)
                                                    <img src="{{ asset('uploads/companies/' . $bookmark->hiring->company->logo) }}" class="img-fluid" width="55" alt="">
                                                @else
                                                    <img src="{{ asset('uploads/companies/default.png') }}" class="img-fluid" width="55" alt="No logo">
                                                @endif
                                            </div>
                                            <div class="cats-box-caption px-2">
                                                <h4 class="fs-md mb-0 ft-medium">{{ optional($bookmark->hiring)->title }}</h4>
                                                <div class="d-block mb-2 position-relative">
                                                    <span class="text-muted medium">
                                                        <i class="lni lni-map-marker mr-1"></i>{{ optional(optional($bookmark->hiring)->location)->name }}
                                                    </span>
                                                    <span class="muted medium ml-2 theme-cl">
                                                        <i class="lni lni-briefcase mr-1"></i>{{ optional(optional($bookmark->hiring)->jobType)->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-info">
                                            @php
                                                $status = optional($bookmark->hiring)->status;
                                            @endphp

                                            @if ($status === 'active')
                                                Còn tuyển
                                            @elseif ($status === 'inactive')
                                                Hết tuyển
                                            @else
                                                Không rõ
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ optional($bookmark->hiring)->deadline }}</td>
                                    <td>
                                        <div class="dash-action">
                                            <a href="{{ route('jobs', optional($bookmark->hiring)->id) }}" class="p-2 circle text-info bg-light-info d-inline-flex align-items-center justify-content-center mr-1"><i class="lni lni-eye"></i></a>
                                            <a href="{{ route('bookmark.delete', $bookmark->id) }}"
                                               onclick="return confirm('Bạn có chắc muốn xóa tin đã lưu này không?')"
                                               class="p-2 circle text-danger bg-light-danger d-inline-flex align-items-center justify-content-center ml-1">
                                                <i class="lni lni-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $bookmarks->appends(request()->all())->links('pagination::bootstrap-4') }}
        </div>

    </div>
    @endsection
