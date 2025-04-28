@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Trang chủ')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/page_home_items/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Trang chủ</h2>

        <form action="{{ route('admin.page_home_items.update', $pageHomeItem->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="heading" name="heading"
                       value="{{ old('heading', $pageHomeItem->heading) }}" required>
                @error('heading')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"
                          rows="3">{{ old('description', $pageHomeItem->description) }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($pageHomeItem->image)
                    <img src="{{ asset('uploads/page_home_items/' . $pageHomeItem->image) }}" alt="Image"
                         style="max-width: 100px; max-height: 100px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="job_placeholder" class="form-label">Job Placeholder</label>
                <input type="text" class="form-control" id="job_placeholder" name="job_placeholder"
                       value="{{ old('job_placeholder', $pageHomeItem->job_placeholder) }}" required>
                @error('job_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_button" class="form-label">Job Button</label>
                <input type="text" class="form-control" id="job_button" name="job_button"
                       value="{{ old('job_button', $pageHomeItem->job_button) }}" required>
                @error('job_button')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_placeholder" class="form-label">Location Placeholder</label>
                <input type="text" class="form-control" id="location_placeholder" name="location_placeholder"
                       value="{{ old('location_placeholder', $pageHomeItem->location_placeholder) }}" required>
                @error('location_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_placeholder" class="form-label">Category Placeholder</label>
                <input type="text" class="form-control" id="category_placeholder" name="category_placeholder"
                       value="{{ old('category_placeholder', $pageHomeItem->category_placeholder) }}" required>
                @error('category_placeholder')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_heading" class="form-label">Job Category Heading</label>
                <input type="text" class="form-control" id="job_category_heading" name="job_category_heading"
                       value="{{ old('job_category_heading', $pageHomeItem->job_category_heading) }}" required>
                @error('job_category_heading')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_description" class="form-label">Job Category Description</label>
                <textarea class="form-control" id="job_category_description" name="job_category_description"
                          rows="3">{{ old('job_category_description', $pageHomeItem->job_category_description) }}</textarea>
                @error('job_category_description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_status" class="form-label">Job Category Status</label>
                <input type="text" class="form-control" id="job_category_status" name="job_category_status"
                       value="{{ old('job_category_status', $pageHomeItem->job_category_status) }}" required>
                @error('job_category_status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.page_home_items.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
