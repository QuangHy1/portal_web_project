@extends('admin.dashboard.layout')

@section('title', 'Quản lý Đơn Ứng Tuyển')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_applications/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Đơn Ứng Tuyển</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.employee_applications.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm đơn ứng tuyển..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <div>
                <a href="{{ route('admin.employee_applications.create') }}" class="btn btn-success">
                    + THÊM
                </a>
                <a href="{{ route('admin.employee_applications.review') }}" class="btn btn-primary mr-2">
                    Duyệt
                </a>
            </div>
        </div>

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
                    <th>Người tìm việc</th>
                    <th>Vị trí ứng tuyển</th> <th>CV</th>
                    <th>Lời nhắn</th>
                    <th>Trạng thái</th>
                    <th>Điểm tương đồng</th>
                    <th>Ngày nộp</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employeeApplications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->employee->firstname }} {{ $application->employee->lastname }}</td>
                        <td>{{ $application->hiring->title }}</td> <td>
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
                            {{-- Chuyển đổi trạng thái sang tiếng Việt --}}
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
                        <td>{{ $application->similarityScore }}</td>
                        <td>{{ $application->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.employee_applications.edit', $application->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.employee_applications.destroy', $application->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $employeeApplications->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
