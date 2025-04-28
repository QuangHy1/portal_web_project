@extends('admin.dashboard.layout')

@section('title', 'Quản lý Lưu tin tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_bookmarks/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Tin tuyển dụng đã lưu</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.employee_bookmarks.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm theo người tìm việc, vị trí..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.employee_bookmarks.create') }}" class="btn btn-success">
                + THÊM
            </a>
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
                    <th>Tin tuyển dụng</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employeeBookmarks as $bookmark)
                    <tr>
                        <td>{{ $bookmark->id }}</td>
                        <td>{{ $bookmark->employee->firstname }} {{ $bookmark->employee->lastname }}</td>
                        <td>{{ $bookmark->hiring->title }}</td>
                        <td>{{ $bookmark->hiring->description }}</td>
                        <td>{{ $bookmark->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.employee_bookmarks.edit', $bookmark->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.employee_bookmarks.destroy', $bookmark->id) }}" method="POST" style="display: inline-block;">
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
            {{ $employeeBookmarks->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
