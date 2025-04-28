@extends('admin.dashboard.layout')
@section('title', 'Duyệt Đơn Ứng Tuyển')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_applications/review.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Duyệt Đơn Ứng Tuyển</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nhân viên</th>
                    <th>Vị trí ứng tuyển</th>
                    <th>CV</th>
                    <th>Lời nhắn</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employeeApplications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->employee->firstname }} {{ $application->employee->lastname }}</td>
                        <td>{{ $application->hiring->title }}</td>
                        <td>
                            @if ($application->resume)
                                <a href="{{ route('admin.resumes.show', $application->resume->id) }}" target="_blank">
                                    {{ $application->resume->file_name }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $application->cover_letter }}</td>
                        <td>
                            @if ($application->status == 'pending')
                                Chờ xử lý
                            @elseif ($application->status == 'approved')
                                Đã duyệt
                            @elseif ($application->status == 'rejected')
                                Đã từ chối
                            @else
                                {{ $application->status }}
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.employee_applications.approve', $application->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Duyệt</button>
                            </form>
                            <form action="{{ route('admin.employee_applications.reject', $application->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-danger">Từ chối</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $employeeApplications->links('pagination::bootstrap-5') }}
        </div>
        <a href="{{ route('admin.employee_applications.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
@endsection
