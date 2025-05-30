@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Hình thức làm việc')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/job_types/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Hình thức làm việc</h2>

        <form action="{{ route('admin.job_types.update', $jobType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $jobType->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.job_types.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
