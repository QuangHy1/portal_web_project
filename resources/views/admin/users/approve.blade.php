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
                    <th>Hành động</th>
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
                                @else
                                    {{ $user->status }}
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
                        <tr><td colspan="6" class="text-center">Không có tài khoản nào cần duyệt.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
@endsection
