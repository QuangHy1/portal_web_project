@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa vai trò')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/roles/edit.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Chỉnh Sửa Vai Trò</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên vai trò</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection

