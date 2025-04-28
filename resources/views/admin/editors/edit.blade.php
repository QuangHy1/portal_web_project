@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Editor')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/editors/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Chỉnh sửa Editor</h2>

        <form action="{{ route('admin.editors.update', $editor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="full_name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $editor->full_name }}" required>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $editor->user_id }}" readonly>
                <small class="text-muted">Không thể thay đổi User ID.</small>
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">Vị trí</label>
                <select class="form-select" id="location_id" name="location_id">
                    <option value="">-- Chọn vị trí --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $editor->location_id == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $editor->date_of_birth }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $editor->gender == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Nam</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $editor->gender == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Nữ</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ $editor->gender == 'other' ? 'checked' : '' }}>
                    <label class="form-check-label" for="other">Khác</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $editor->phone }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $editor->address }}">
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="3">{{ $editor->bio }}</textarea>
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                @if ($editor->avatar)
                    <img src="{{ asset('storage/uploads/editors/' . $editor->avatar) }}" alt="Avatar" class="avatar-img mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label for="post_count" class="form-label">Số bài viết</label>
                <input type="number" class="form-control" id="post_count" name="post_count" value="{{ $editor->post_count }}" min="0">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.editors.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
