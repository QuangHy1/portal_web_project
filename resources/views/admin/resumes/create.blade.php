@extends('admin.dashboard.layout')

@section('title', 'Thêm mới CV')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/resumes/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Thêm mới CV</h2>

        <form action="{{ route('admin.resumes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">Người tìm việc</label>
                <select class="form-select" id="employee_id" name="employee_id" required>
                    <option value="">Chọn </option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->firstname }} {{ $employee->lastname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File CV</label>
                <input type="file" class="form-control" id="file" name="file" required>
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.resumes.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
