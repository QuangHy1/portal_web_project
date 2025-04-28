@extends('admin.dashboard.layout')

@section('title', 'Quản lý Lĩnh vực')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/industries/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Lĩnh vực</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.industries.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm lĩnh vực..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.industries.create') }}" class="btn btn-success">
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
                @foreach ($industries as $industry)
                    <tr>
                        <td>{{ $industry->id }}</td>
                        <td>{{ $industry->name }}</td>
                        <td>
                            <a href="{{ route('admin.industries.edit', $industry->id) }}"
                               class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.industries.destroy', $industry->id) }}" method="POST" style="display: inline-block;">
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
            {{ $industries->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
