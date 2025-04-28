@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Đơn Ứng Tuyển')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_applications/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Đơn Ứng Tuyển</h2>

        <form action="{{ route('admin.employee_applications.update', $employeeApplication->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_id" class="form-label">Người tìm việc</label>
                <select class="form-select" id="employee_id" name="employee_id" required>
                    <option value="">Chọn </option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id', $employeeApplication->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->firstname }} {{ $employee->lastname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hiring_id" class="form-label">Vị trí ứng tuyển</label>
                <select class="form-select" id="hiring_id" name="hiring_id" required>
                    <option value="">Chọn vị trí</option>
                    @foreach ($hirings as $hiring)
                        <option value="{{ $hiring->id }}" {{ old('hiring_id', $employeeApplication->hiring_id) == $hiring->id ? 'selected' : '' }}>
                            {{ $hiring->title }}
                        </option>
                    @endforeach
                </select>
                @error('hiring_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="resume_id" class="form-label">CV</label>
                <select class="form-select" id="resume_id" name="resume_id">
                    <option value="">Chọn CV (tùy chọn)</option>
                    @foreach ($resumes as $resume)
                        <option value="{{ $resume->id }}" {{ old('resume_id', $employeeApplication->resume_id) == $resume->id ? 'selected' : '' }}>
                            {{ $resume->file_name }}
                        </option>
                    @endforeach
                </select>
                @error('resume_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_letter" class="form-label">Lời nhắn</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" required>{{ old('cover_letter', $employeeApplication->cover_letter) }}</textarea>
                @error('cover_letter')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" {{ old('status', $employeeApplication->status) == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="approved" {{ old('status', $employeeApplication->status) == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="rejected" {{ old('status', $employeeApplication->status) == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="similarityScore" class="form-label">Điểm tương đồng</label>
                <input type="number" class="form-control" id="similarityScore" name="similarityScore" value="{{ old('similarityScore', $employeeApplication->similarityScore) }}" required>
                @error('similarityScore')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.employee_applications.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
