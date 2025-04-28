@extends('admin.dashboard.layout')

@section('title', 'Quản lý Top Bars')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/top_bars/index.css') }}">
@endsection


@section('content')
    <div class="container">
        <h2>Danh sách Top Bars</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.top_bars.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm top bars..." value="{{ $keyword ?? '' }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <a href="{{ route('admin.top_bars.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Topbar Contact</th>
                <th>Topbar Center Text</th>
                <th>Ẩn</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($topBars as $topBar)
                <tr>
                    <td>{{ $topBar->id }}</td>
                    <td>{{ $topBar->topbar_contact }}</td>
                    <td>{{ $topBar->topbar_center_text }}</td>
                    <td>{{ $topBar->isHidden ? 'Có' : 'Không' }}</td>
                    <td>{{ $topBar->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $topBar->updated_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <a href="{{ route('admin.top_bars.edit', $topBar->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.top_bars.destroy', $topBar->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $topBars->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
