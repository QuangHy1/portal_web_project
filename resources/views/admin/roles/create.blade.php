@extends('admin.dashboard.layout')

@section('title', 'Thêm vai trò')

@section('content')
    <div class="container mt-4">
        <h2>Thêm Vai Trò Mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên vai trò</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên vai trò..." value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
