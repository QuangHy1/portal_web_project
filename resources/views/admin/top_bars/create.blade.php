@extends('admin.dashboard.layout')

@section('title', 'Tạo Top Bar Mới')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/top_bars/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Tạo Top Bar Mới</h2>

        <form action="{{ route('admin.top_bars.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="topbar_contact" class="form-label">Topbar Contact</label>
                <input type="text" class="form-control" id="topbar_contact" name="topbar_contact" value="{{ old('topbar_contact') }}" required>
                @error('topbar_contact')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="topbar_center_text" class="form-label">Topbar Center Text</label>
                <input type="text" class="form-control" id="topbar_center_text" name="topbar_center_text" value="{{ old('topbar_center_text') }}" required>
                @error('topbar_center_text')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isHidden" class="form-label">Ẩn</label>
                <select class="form-select" id="isHidden" name="isHidden">
                    <option value="0" {{ old('isHidden', false) ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ old('isHidden', true) ? 'selected' : '' }}>Có</option>
                </select>
                @error('isHidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tạo mới</button>
            <a href="{{ route('admin.top_bars.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
