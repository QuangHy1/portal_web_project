@extends('admin.dashboard.layout')

@section('title', 'Vai trò')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/roles/index.css') }}">
@endsection
@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách vai trò</h2>

        <!-- Thanh tìm kiếm & nút thêm -->
        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Ô tìm kiếm -->
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.roles.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm vai trò..." value="{{ request('keyword') }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <!-- Nút thêm -->
            <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        <!-- Bảng danh sách -->
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên vai trò</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $key => $role)
                <tr>
                    <td>{{ $roles->firstItem() + $key }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Không tìm thấy quyền nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Thanh phân trang -->
        <div class="d-flex justify-content-center">
            {{ $roles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
