@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Danh mục Nghề nghiệp')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/job_categories/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Danh mục Nghề nghiệp</h2>

        <form action="{{ route('admin.job_categories.update', $jobCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $jobCategory->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Biểu tượng</label>
                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $jobCategory->icon) }}" required>
                @error('icon')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.job_categories.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
