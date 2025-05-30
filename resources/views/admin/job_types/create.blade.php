@extends('admin.dashboard.layout')

@section('title', 'Thêm mới Hình thức làm việc')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/job_types/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Thêm mới Hình thức làm việc</h2>

        <form action="{{ route('admin.job_types.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.job_types.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
