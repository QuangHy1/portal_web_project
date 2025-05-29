@extends('admin.dashboard.layout')

@section('title', 'Quản lý Danh mục Nghề nghiệp')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/job_categories/index.css') }}">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <style>
        .icon-preview {
            font-size: 24px; /* Điều chỉnh kích thước icon cho phù hợp */
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách danh mục Ngành Nghề</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.job_categories.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm danh mục..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.job_categories.create') }}" class="btn btn-success">
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
                    <th>Tên</th>
                    <th>Biểu tượng</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($jobCategories as $jobCategory)
                    <tr>
                        <td>{{ $jobCategory->id }}</td>
                        <td>{{ $jobCategory->name }}</td>
                        <td>
                                <span class="icon-preview">
                                    <i class="{{ $jobCategory->icon }}"></i>
                                </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.job_categories.edit', $jobCategory->id) }}"
                               class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.job_categories.destroy', $jobCategory->id) }}" method="POST" style="display: inline-block;">
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
            {{ $jobCategories->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
