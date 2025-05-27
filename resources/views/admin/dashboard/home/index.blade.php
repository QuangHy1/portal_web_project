@extends('admin.dashboard.layout')

@section('title', 'Dashboard - Trang chủ')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard/index.css') }}">
@endsection

@section('content')
    <h3 class="fw-bold fs-4 mb-4">Tổng quan hệ thống</h3>

    <div class="row g-4 mb-4">
        <!-- Tổng tài khoản Employee -->
        <div class="col-md-4">
            <div class="card  border-0">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted">Tài khoản Ứng viên</h6>
                    <h3 class="fw-bold text-primary">{{ $employeeCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Tổng tài khoản Employer -->
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted">Tài khoản Nhà tuyển dụng</h6>
                    <h3 class="fw-bold text-success">{{ $employerCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Tổng tin tuyển dụng trong tuần -->
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted">Tin tuyển dụng trong tuần</h6>
                    <h3 class="fw-bold text-info">{{ $hiringCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Giao dịch Boost tuần này -->
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted">Giao dịch Boost trong tuần</h6>
                    <h3 class="fw-bold text-warning">{{ $boostCount }}</h3>
                </div>
            </div>
        </div>

        <!-- Doanh thu -->
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-muted">Doanh thu tuần này</h6>
                    <h3 class="fw-bold text-danger">{{ number_format($thisWeekRevenue) }} ₫</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiệu suất doanh thu -->
    <h3 class="fw-bold fs-4 mb-3">Hiệu suất doanh thu</h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
            <tr>
                <th>Tuần trước</th>
                <th>Tuần này</th>
                <th>Chênh lệch</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ number_format($lastWeekRevenue) }} ₫</td>
                <td>{{ number_format($thisWeekRevenue) }} ₫</td>
                <td>
                    @if ($revenueChange > 0)
                        <span class="text-success fw-bold">+{{ $revenueChange }}%</span>
                    @elseif ($revenueChange < 0)
                        <span class="text-danger fw-bold">{{ $revenueChange }}%</span>
                    @else
                        <span class="text-muted">Không thay đổi</span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- Biểu đồ doanh thu -->
    <h3 class="fw-bold fs-4 mb-3 mt-5">Biểu đồ doanh thu</h3>
    <div class="w-100">
        <div id="revenueChart"></div>
    </div>
@endsection
@section('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const options = {
            chart: {
                type: 'line', // nếu bạn đã chuyển sang biểu đồ đường
                height: 350,
                width: '100%' // <-- đảm bảo biểu đồ chiếm 100% chiều rộng container
            },
            series: [{
                name: 'Doanh thu (VNĐ)',
                data: [{{ $lastWeekRevenue }}, {{ $thisWeekRevenue }}]
            }],
            xaxis: {
                categories: ['Tuần trước', 'Tuần này'],
                labels: {
                    style: {
                        fontWeight: 'bold'
                    }
                }
            },
            colors: ['#0d6efd'],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toLocaleString() + ' ₫';
                },
                style: {
                    fontWeight: 'bold'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 5,
                colors: ['#0d6efd'],
                strokeWidth: 2,
                hover: {
                    sizeOffset: 3
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val.toLocaleString() + ' ₫';
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
        chart.render();
    </script>
@endsection
