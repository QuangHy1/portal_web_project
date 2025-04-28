@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Tin được luu')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_bookmarks/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Tin được lưu</h2>

        <form action="{{ route('admin.employee_bookmarks.update', $employeeBookmark->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_id" class="form-label">Người tìm việc</label>
                <select class="form-select" id="employee_id" name="employee_id" required>
                    <option value="">Chọn </option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employeeBookmark->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->firstname }} {{ $employee->lastname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hiring_id" class="form-label">Vị trí tuyển dụng</label>
                <select class="form-select" id="hiring_id" name="hiring_id" required>
                    <option value="">Chọn vị trí tuyển dụng</option>
                    @foreach ($hirings as $hiring)
                        <option value="{{ $hiring->id }}" {{ $employeeBookmark->hiring_id == $hiring->id ? 'selected' : '' }}>
                            {{ $hiring->title }}
                        </option>
                    @endforeach
                </select>
                @error('hiring_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.employee_bookmarks.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
