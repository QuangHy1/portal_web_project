@extends('admin.dashboard.layout')

@section('title', 'Thêm mới Đơn Ứng Tuyển')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employee_applications/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Thêm mới Đơn Ứng Tuyển</h2>

        <form action="{{ route('admin.employee_applications.store') }}" method="POST">
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
                <label for="hiring_id" class="form-label">Vị trí ứng tuyển</label>
                <select class="form-select" id="hiring_id" name="hiring_id" required>
                    <option value="">Chọn vị trí</option>
                    @foreach ($hirings as $hiring)
                        <option value="{{ $hiring->id }}" {{ old('hiring_id') == $hiring->id ? 'selected' : '' }}>
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
                        <option value="{{ $resume->id }}" {{ old('resume_id') == $resume->id ? 'selected' : '' }}>
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
                <textarea class="form-control" id="cover_letter" name="cover_letter" required>{{ old('cover_letter') }}</textarea>
                @error('cover_letter')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="similarityScore" class="form-label">Điểm tương đồng</label>
                <input type="number" class="form-control" id="similarityScore" name="similarityScore" value="{{ old('similarityScore') }}" required>
                @error('similarityScore')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.employee_applications.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
