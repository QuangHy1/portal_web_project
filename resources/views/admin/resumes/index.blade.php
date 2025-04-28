@extends('admin.dashboard.layout')

@section('title', 'Quản lý CV')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/resumes/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách CV</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.resumes.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm CV..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.resumes.create') }}" class="btn btn-success">
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
                    <th>Tên file</th>
                    <th>Tiêu đề</th>
                    <th>Loại file</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($resumes as $resume)
                    <tr>
                        <td>{{ $resume->id }}</td>
                        <td>{{ $resume->employee->firstname }} {{ $resume->employee->lastname }}</td>
                        <td>{{ $resume->file_name }}</td>
                        <td>{{ $resume->title }}</td>
                        <td>{{ $resume->file_type }}</td>
                        <td>{{ $resume->created_at }}</td>
                        <td>
                            <div class="d-flex flex-wrap justify-content-center gap-1">
                                <a href="{{ route('admin.resumes.show', $resume->id) }}" class="btn btn-sm btn-info" target="_blank">Xem</a>
                                <a href="{{ route('admin.resumes.edit', $resume->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="{{ route('admin.resumes.download', $resume->id) }}" class="btn btn-sm btn-primary">Tải xuống</a>
                                <form action="{{ route('admin.resumes.destroy', $resume->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $resumes->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
