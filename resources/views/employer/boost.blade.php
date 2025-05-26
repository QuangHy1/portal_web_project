@php use Illuminate\Support\Facades\Auth; @endphp
@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
@include('Frontend.layouts.employerDashboardNav')

<div class="dashboard-content">
    <div class="dashboard-tlbar d-block mb-5">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <h1 class="ft-medium">Tin Được Boost</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-muted"><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" class="theme-cl">Tin Được Boost</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="dashboard-widg-bar d-block">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                {{-- <div class="d-flex align-items-center p-3 alert alert-danger">
                    Your listings will be automatically removed after 30 days.
                </div> --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Số tin đã boost:</strong> {{ $usedBoosts }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <strong>Số lượt boost còn lại:</strong> {{ $remainingBoosts }}
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('employer.boost.purchase') }}" class="btn btn-success mt-2">
                            <i class="fa fa-plus-circle"></i> Mua gói boost
                        </a>
                    </div>
                </div>

                {{-- Thêm đoạn hiển thị ngày hết hạn --}}
                @if ($activeBoostOrder)
                    <div class="alert alert-info1">
                        <strong>Gói hiện tại: {{ $activeBoostOrder->package->name }}</strong>
                    </div>
                    <div class="alert alert-info1">
                        <strong>Ngày hết hạn gói boost hiện tại:</strong>
                        {{ \Carbon\Carbon::parse($activeBoostOrder->date_expired)->format('d - m - Y') }}
                    </div>
                @endif
                <div class="mb-4 tbl-lg rounded overflow-hidden">
                    <div class="table-responsive bg-white">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Tiêu Đề</th>
                                    <th scope="col">Trạng thái</th>
                                  <th scope="col">Trạng Thái Boost</th>{{-- Filled --}}
                                  <th scope="col">Ngày Boost</th>
                                  <th scope="col">Hạn Boost</th>
                                  <th scope="col">Số Người Apply</th>
                                  <th scope="col">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($hirings as $item)
{{--                                @php--}}

{{--                                    $userID = Auth::user()->id;--}}

{{--                                @endphp--}}
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
                                        <td>
                                            @php
                                                $boosted = \App\Models\BoostedJob::where('hiring_id', $item->id)->latest()->first();
                                            @endphp
                                            @if ($item->isBoosted === 'yes' && $boosted && $boosted->boosted_at)
                                                {{ \Carbon\Carbon::parse($boosted->boosted_at)->format('d - m - Y') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->isBoosted === 'yes' && $boosted && $boosted->expires_at)
                                                {{ \Carbon\Carbon::parse($boosted->expires_at)->format('d - m - Y') }}
                                            @else
                                                —
                                            @endif
                                        </td>
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
                                                @if($item->status == 'inactive')
                                                    <span class="btn btn-danger">Không Boost Được</span>
                                                @elseif($item->isBoosted == 'yes')
                                                    <form method="POST" action="{{ route('employer.hiring.boost.revert', $item->id) }}" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark" onclick="return confirm('Bạn có chắc muốn hoàn tác boost không?');">
                                                            Hoàn tác
                                                        </button>
                                                    </form>
                                                @else
                                                    @if($remainingBoosts > 0)
                                                        <form method="POST" action="{{ route('employer.employee.boost.now', $item->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Boost ngay</button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('employer.employee.boost.submit', $item->id) }}" class="btn btn-warning">Mua thêm slot Boost</a>
                                                    @endif
                                                @endif
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
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Đóng',
                    timer: 4000,
                    timerProgressBar: true
                });
            });
        </script>
@endif
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
@endif

@endsection
