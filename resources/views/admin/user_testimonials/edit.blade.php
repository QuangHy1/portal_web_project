@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Đánh giá Người dùng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/user_testimonials/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Đánh giá Người dùng</h2>

        <form action="{{ route('admin.user_testimonials.update', $userTestimonial->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_id" class="form-label">Người dùng</label>
                <select class="form-select" id="employee_id" name="employee_id" required>
                    <option value="">Chọn người dùng</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('employee_id', $userTestimonial->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->firstname }} {{ $employee->lastname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Chức danh</label>
                <input type="text" class="form-control" id="designation" name="designation"
                       value="{{ old('designation', $userTestimonial->designation) }}" required>
                @error('designation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Công ty</label>
                <input type="text" class="form-control" id="company" name="company"
                       value="{{ old('company', $userTestimonial->company) }}" required>
                @error('company')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <small class="text-muted">Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif, svg. Kích thước tối đa: 2MB.</small>
                @if ($userTestimonial->image)
                    <img src="{{ asset('storage/uploads/testimonials/' . $userTestimonial->image) }}" alt="Hình ảnh cũ"
                         class="img-thumbnail mt-2" style="max-width: 100px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="testimonial" class="form-label">Đánh giá</label>
                <textarea class="form-control" id="testimonial" name="testimonial" rows="3" required>{{ old('testimonial', $userTestimonial->testimonial) }}</textarea>
                @error('testimonial')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isFeatured" class="form-label">Nổi bật</label>
                <select class="form-select" id="isFeatured" name="isFeatured" required>
                    <option value="no" {{ old('isFeatured', $userTestimonial->isFeatured) == 'no' ? 'selected' : '' }}>Không
                    </option>
                    <option value="yes" {{ old('isFeatured', $userTestimonial->isFeatured) == 'yes' ? 'selected' : '' }}>Có
                    </option>
                </select>
                @error('isFeatured')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.user_testimonials.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
