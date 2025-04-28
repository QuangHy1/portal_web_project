@extends('admin.dashboard.layout')

@section('title', 'Quản lý Kinh nghiệm')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/experiences/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Kinh nghiệm</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.experiences.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm kinh nghiệm..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-success">
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
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($experiences as $experience)
                    <tr>
                        <td>{{ $experience->id }}</td>
                        <td>{{ $experience->name }}</td>
                        <td>
                            <a href="{{ route('admin.experiences.edit', $experience->id) }}"
                               class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.experiences.destroy', $experience->id) }}" method="POST" style="display: inline-block;">
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
            {{ $experiences->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
