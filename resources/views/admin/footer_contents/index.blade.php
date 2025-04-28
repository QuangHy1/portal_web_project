@extends('admin.dashboard.layout')

@section('title', 'Quản lý Nội dung Footer')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/top_bars/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Nội dung Footer</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.footer_contents.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <div>
                <a href="{{ route('admin.footer_contents.create') }}" class="btn btn-success">
                    + THÊM
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Địa chỉ</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>Instagram</th>
                <th>LinkedIn</th>
                <th>YouTube</th>
                <th>Bản quyền</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($footerContents as $footerContent)
                <tr>
                    <td>{{ $footerContent->address }}</td>
                    <td>{{ $footerContent->phone }}</td>
                    <td>{{ $footerContent->email }}</td>
                    <td>{{ $footerContent->facebook }}</td>
                    <td>{{ $footerContent->twitter }}</td>
                    <td>{{ $footerContent->instagram }}</td>
                    <td>{{ $footerContent->linkedin }}</td>
                    <td>{{ $footerContent->youtube }}</td>
                    <td>{{ $footerContent->copyright_text }}</td>
                    <td>
                        <a href="{{ route('admin.footer_contents.edit', $footerContent->id) }}"
                           class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.footer_contents.destroy', $footerContent->id) }}" method="POST" style="display: inline-block;">
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
        <div class="d-flex justify-content-center">
            {{ $footerContents->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
