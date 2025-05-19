@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
@include('Frontend.layouts.employeeDashboardNav')

    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Tin Đã Apply</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="theme-cl">Apply</a></li>
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
                            <p class="m-0 p-0 ft-sm">Bạn đã Apply
                                <span class="text-dark ft-medium">
                                    {{ $applications->total() }}
                                </span> công việc.
                            </p>
                        </div>

                        <div class="cl-justify-last">
                            <div class="d-flex align-items-center justify-content-left">
                                <form method="GET" action="{{ route('employee.job.applied') }}">
                                    <div class="d-flex align-items-center justify-content-left">
                                        <div class="dlc-list">
                                            <select class="form-control sm rounded" name="job_type" onchange="this.form.submit()">
                                                <option value="">Tất cả công việc</option>
                                                @foreach($jobTypes as $type)
                                                    <option value="{{ $type }}" {{ request('job_type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="dlc-list ml-2">
                                            <select class="form-control sm rounded" name="per_page" onchange="this.form.submit()">
                                                @foreach($perPageOptions as $option)
                                                    <option value="{{ $option }}" {{ request('per_page') == $option ? 'selected' : '' }}>
                                                        Xem {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>

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
                                      <th scope="col">Ngày Apply</th>
                                      <th scope="col">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($applications->count() > 0)
                                        @foreach($applications as $data)
                                        <tr>
                                            <td>
                                                <div class="cats-box rounded bg-white d-flex align-items-center">
                                                    <div class="text-center">
                                                        <img src="{{ asset('uploads/companies/' . $data->hiring->company->logo) }}" class="img-fluid" width="55" alt="">
                                                    </div>
                                                    <div class="cats-box-caption px-2">
                                                        <h4 class="fs-md mb-0 ft-medium">{{ $data->hiring->title }}</h4>
                                                        <div class="d-block mb-2 position-relative">
                                                            <span class="text-muted medium"><i class="lni lni-map-marker mr-1"></i>{{ $data->hiring->location->name }}</span>
                                                            <span class="muted medium ml-2 theme-cl"><i class="lni lni-briefcase mr-1"></i>{{ $data->hiring->jobType->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @php
                                                $statusMap = [
                                                    'pending' => ['label' => 'Chờ duyệt', 'class' => 'warning'],
                                                    'approved' => ['label' => 'Đã duyệt', 'class' => 'success'],
                                                    'rejected' => ['label' => 'Từ chối', 'class' => 'danger'],
                                                ];
                                                $status = $data->status;
                                                $statusLabel = $statusMap[$status]['label'] ?? ucfirst($status);
                                                $statusClass = $statusMap[$status]['class'] ?? 'secondary';
                                            @endphp
                                            <td>
                                                <span class="badge badge-{{ $statusClass }}">{{ $statusLabel }}</span>
                                            </td>
                                            <td>{{ date('d - m - Y', strtotime($data->created_at)) }}</td>
                                            <td>
                                                <div class="dash-action">
                                                    <a href="{{ route('jobs', $data->hiring->id) }}" class="p-2 circle text-info bg-light-info d-inline-flex align-items-center justify-content-center mr-1"><i class="lni lni-eye"></i></a>
                                                    <a href="javascript:void(0);" class="p-2 circle text-danger bg-light-danger d-inline-flex align-items-center justify-content-center ml-1"><i class="lni lni-trash-can"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                      @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Bạn chưa apply công việc nào.</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $applications->appends(request()->query())->links() }}
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
