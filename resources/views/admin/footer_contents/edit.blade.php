@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Nội dung Footer')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/footer_contents/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Nội dung Footer</h2>

        <form action="{{ route('admin.footer_contents.update', $footerContent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{ old('address', $footerContent->address) }}" required>
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="{{ old('phone', $footerContent->phone) }}" required>
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', $footerContent->email) }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook"
                       value="{{ old('facebook', $footerContent->facebook) }}">
                @error('facebook')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter"
                       value="{{ old('twitter', $footerContent->twitter) }}">
                @error('twitter')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram"
                       value="{{ old('instagram', $footerContent->instagram) }}">
                @error('instagram')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="linkedin" class="form-label">LinkedIn</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin"
                       value="{{ old('linkedin', $footerContent->linkedin) }}">
                @error('linkedin')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="youtube" class="form-label">YouTube</label>
                <input type="text" class="form-control" id="youtube" name="youtube"
                       value="{{ old('youtube', $footerContent->youtube) }}">
                @error('youtube')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="copyright_text" class="form-label">Bản quyền</label>
                <input type="text" class="form-control" id="copyright_text" name="copyright_text"
                       value="{{ old('copyright_text', $footerContent->copyright_text) }}" required>
                @error('copyright_text')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.footer_contents.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
