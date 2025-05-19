@extends('admin.dashboard.layout')
@section('title', 'Duyệt Email Nhà Tuyển Dụng')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/users/approve.css') }}">
@endsection
@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách nhà tuyển dụng chưa duyệt email</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Trạng thái Email</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employersToVerify as $employer)
                    <tr>
                        <td>{{ $employer->id }}</td>
                        <td>{{ $employer->user->username }}</td>
                        <td>{{ $employer->full_name }}</td>
                        <td>{{ $employer->email }}</td>
                        <td>
                            <span class="badge bg-danger">Chưa duyệt</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.employers.verify', $employer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-sm btn-success">Duyệt</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Không có nhà tuyển dụng nào cần duyệt email.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.employers.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách nhà tuyển dụng</a>
    </div>
@endsection
