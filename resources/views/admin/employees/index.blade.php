@extends('admin.dashboard.layout')

@section('title', 'Quản lý Người tìm việc')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employees/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Người tìm việc</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.employees.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm ứng viên..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach ($employees as $employee)
                <div class="col-md-4">
                    <div class="employee-card text-center">
                        <img src="{{ $employee->photo ? asset($employee->photo) : asset('admin/images/default-avatar.png') }}" alt="Avatar" class="employee-avatar">
                        <div class="employee-name">
                            {{ $employee->firstname }} {{ $employee->lastname }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-envelope"></i> {{ $employee->user->email ?? 'N/A' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-map"></i> {{ $employee->location->name ?? 'N/A' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-briefcase"></i> {{ $employee->designation ?? 'Chưa cập nhật' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-phone"></i> {{ $employee->phone ?? 'N/A' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-home"></i> {{ $employee->address ?? 'N/A' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-user"></i>
                            @if ($employee->gender == 'male')
                                Nam
                            @elseif ($employee->gender == 'female')
                                Nữ
                            @elseif ($employee->gender == 'other')
                                Khác
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-calendar"></i> {{ $employee->date_of_birth ?? 'N/A' }}
                        </div>
                        <div class="employee-info">
                            <i class="bx bx-file-text"></i> {{ Str::limit($employee->bio ?? 'Chưa có tiểu sử.', 50) }}
                        </div>
                        <div class="employee-social">
                            @if ($employee->facebook)
                                <a href="{{ $employee->facebook }}" target="_blank" class="social-link"><i class='bx bxl-facebook-circle'></i></a>
                            @endif
                            @if ($employee->github)
                                <a href="{{ $employee->github }}" target="_blank" class="social-link"><i class='bx bxl-github'></i></a>
                            @endif
                            @if ($employee->instagram)
                                <a href="{{ $employee->instagram }}" target="_blank" class="social-link"><i class='bx bxl-instagram-alt'></i></a>
                            @endif
                        </div>
                        <div class="employee-actions d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $employees->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
