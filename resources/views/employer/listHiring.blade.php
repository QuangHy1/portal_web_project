@php use Illuminate\Support\Facades\Auth; @endphp
@extends('Frontend.layouts.masterDashboard')
@section('page_title')Manage Hiring Posts @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
<div class="dashboard-content">
    <div class="dashboard-tlbar d-block mb-5">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <h1 class="ft-medium">Quản Lý Tin</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employer.hiring.list') }}" class="theme-cl">Quản Lý Tin</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="dashboard-widg-bar d-block">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="d-flex align-items-center p-3 alert alert-danger">
                    Tin Tuyển Dụng của bạn sẽ tự động bị xóa sau 30 ngày.
                </div>
                <div class="mb-4 tbl-lg rounded overflow-hidden">
                    <div class="table-responsive bg-white">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Tiêu Đề</th>
                                    <th scope="col">Trạng Thái</th>
                                  <th scope="col">Trạng Thái Boost</th> {{-- Filled --}}
                                  <th scope="col">Ngày Đăng</th>
                                  <th scope="col">Thời Hạn</th>
                                  <th scope="col">Số Người Apply</th>
                                  <th scope="col">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php

                                $count = 0;
                                @endphp
                                @foreach ($hiring as $item)
                                    @php
                                        $userID = Auth::guard('employer')->user()->id;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="dash-title">
                                                <h4 class="mb-0 ft-medium fs-sm">
                                                    {{ $item->title }}
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dash-title">
                                                <span class="medium theme-cl rounded @if($item->status == 'active') text-success bg-light-success @elseif($item->status == 'Draft') text-info bg-light-info @else text-danger bg-light-danger @endif ml-1 py-1 px-2">
                                                    @if($item->status == 'active') Hoạt động @elseif($item->status == 'Draft') Bản nháp @else Không hoạt động @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dash-filled">
                                                @if($item->status == 'inactive')
                                                    <span class="p-2 bg-secondary text-white d-inline-flex align-items-center justify-content-center">
                                                        Tin đã quá hạn
                                                    </span>
                                                @elseif($item->isBoosted == 'yes')
                                                    <span class="p-2 bg-info text-white d-inline-flex align-items-center justify-content-center">
                                                        Boost được áp dụng
                                                    </span>
                                                @else
                                                    <span class="p-2 bg-warning text-white d-inline-flex align-items-center justify-content-center">
                                                        Sẵn sàng để Boost!
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ date('d - m - Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ date('d - m - Y', strtotime($item->deadline)) }}</td>
                                        <td>
                                            <a href="{{ route('employer.hiring.applicants', $item->id) }}" class="gray rounded px-3 py-2 ft-medium">
                                                @php
                                                    $applications = App\Models\EmployeeApplication::where('hiring_id', $item->id)->count();
                                                    echo $applications;
                                                @endphp
                                            </a>
                                        </td>
                                        <td>
                                            <div class="dash-action">
                                                <a href="{{ route('jobs', $item->id) }}" class="p-2 circle text-info bg-light-info d-inline-flex align-items-center justify-content-center mr-1">
                                                    <i class="lni lni-eye"></i>
                                                </a>
                                                <a href="{{ route('employer.hiring.edit', $item->id) }}" class="p-2 circle text-success bg-light-success d-inline-flex align-items-center justify-content-center">
                                                    <i class="lni lni-pencil"></i>
                                                </a>
                                                <form action="{{ route('employer.hiring.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 circle text-danger bg-light-danger d-inline-flex align-items-center justify-content-center ml-1" style="border: none; background: none;">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                     @php
                                        $JOBid = $item->id;
                                         //$JOBid;
                                     @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
