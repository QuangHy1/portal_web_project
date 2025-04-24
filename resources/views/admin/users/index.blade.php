@extends('admin.dashboard.layout')

@section('title', 'Tài khoản người dùng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/users/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách tài khoản</h2>

        <!-- Thanh tìm kiếm & nút thêm -->
        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Ô tìm kiếm -->
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.users.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm tài khoản..." value="{{ request('keyword') }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <!-- Nút thêm -->
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                + THÊM
            </a>

            <!-- Nút duyệt tài khoản -->
            <a href="#" class="btn btn-success btn-duyet">{{--Có thể là {{ route('admin.users.approve') }}--}}
                + DUYỆT
            </a>
        </div>

        <!-- Bảng danh sách -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Email đã xác thực</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody id="userTable">
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i:s') : 'Chưa xác thực' }}
                        </td>
                        <td>
                            {!! $user->getRoleBadgeHtml() !!}
                        </td>
                        <td>{{ $user->status_label }}</td>
                        <td>
                            @if($user->created_at)
                                {{ $user->created_at->format('d/m/Y H:i:s') }}
                            @else
                                Không rõ
                            @endif
                        </td>
                        <td>
                            @if($user->updated_at)
                                {{ $user->updated_at->format('d/m/Y H:i:s') }}
                            @else
                                Không rõ
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Không tìm thấy tài khoản người dùng nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Thanh phân trang -->
        <div class="d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection
{{--@section('custom_js')--}}
{{--    <link rel="stylesheet" href="{{ asset('admin/js/admin/users/index.js') }}">--}}
{{--@endsection--}}
