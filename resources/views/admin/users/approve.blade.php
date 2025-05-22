@extends('admin.dashboard.layout')

@section('title', 'Duyệt tài khoản')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/users/approve.css') }}">
@endsection
@section('content')
    <div class="container">
        <h2 class="my-4">Duyệt Tài Khoản Người Dùng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Duyệt email</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($usersToApprove as $user)
{{--                        @dd($user)--}}
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? 'N/A' }}</td>
                            <td>
                                @if($user->status === 'inactive')
                                    <span class="badge bg-warning">Chưa duyệt</span>
                                @elseif($user->status === 'active')
                                    <span class="badge bg-success">Hoạt động</span>
                                @elseif($user->status === 'banned')
                                    <span class="badge bg-danger">Đã bị chặn</span>
                                @else
                                    <span class="badge bg-secondary">{{ $user->status }}</span> {{-- fallback nếu có trạng thái khác --}}
                                @endif
                            </td>
                            <td>
                                @if($user->employer && $user->employer->isverified == 0)
                                    <span class="badge bg-danger">Chưa duyệt email</span>
                                @else
                                    <span class="badge bg-success">Đã duyệt email</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.users.approve', ['user' => $user->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-sm btn-success">Duyệt</button>
                                </form>
                                <form action="{{ route('admin.users.reject', ['user' => $user->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn từ chối tài khoản này?')">Từ chối</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">Không có tài khoản nào cần duyệt.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
@endsection
