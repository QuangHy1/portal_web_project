@extends('admin.dashboard.layout')

@section('title', 'Tạo mới Trang chủ')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/page_home_items/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Tạo mới Trang chủ</h2>

        <form action="{{ route('admin.page_home_items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="heading" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading') }}"
                       required>
                @error('heading')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" required>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_placeholder" class="form-label">Công việc Placeholder</label>
                <input type="text" class="form-control" id="job_placeholder" name="job_placeholder"
                       value="{{ old('job_placeholder') }}" required>
                @error('job_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_button" class="form-label">Nút </label>
                <input type="text" class="form-control" id="job_button" name="job_button"
                       value="{{ old('job_button') }}" required>
                @error('job_button')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_placeholder" class="form-label">Địa điểm Placeholder</label>
                <input type="text" class="form-control" id="location_placeholder" name="location_placeholder"
                       value="{{ old('location_placeholder') }}" required>
                @error('location_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_placeholder" class="form-label">Danh mục Placeholder</label>
                <input type="text" class="form-control" id="category_placeholder" name="category_placeholder"
                       value="{{ old('category_placeholder') }}" required>
                @error('category_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_heading" class="form-label">Tiêu đề danh mục</label>
                <input type="text" class="form-control" id="job_category_heading" name="job_category_heading"
                       value="{{ old('job_category_heading') }}" required>
                @error('job_category_heading')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_description" class="form-label">Mô tả danh mục </label>
                <textarea class="form-control" id="job_category_description" name="job_category_description"
                          rows="3">{{ old('job_category_description') }}</textarea>
                @error('job_category_description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_status" class="form-label">Trạng thái danh mục </label>
                <input type="text" class="form-control" id="job_category_status" name="job_category_status"
                       value="{{ old('job_category_status') }}" required>
                @error('job_category_status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.page_home_items.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
