@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Mức lương')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/salary_ranges/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Mức lương</h2>

        <form action="{{ route('admin.salary_ranges.update', $salaryRange->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $salaryRange->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.salary_ranges.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
