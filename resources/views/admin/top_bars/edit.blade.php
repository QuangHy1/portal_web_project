@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Top Bar')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/top_bars/edit.css') }}">
@endsection


@section('content')
    <div class="container">
        <h2>Chỉnh sửa Top Bar</h2>

        <form action="{{ route('admin.top_bars.update', $topBar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="topbar_contact" class="form-label">Topbar Contact</label>
                <input type="text" class="form-control" id="topbar_contact" name="topbar_contact" value="{{ old('topbar_contact', $topBar->topbar_contact) }}" required>
                @error('topbar_contact')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="topbar_center_text" class="form-label">Topbar Center Text</label>
                <input type="text" class="form-control" id="topbar_center_text" name="topbar_center_text" value="{{ old('topbar_center_text', $topBar->topbar_center_text) }}" required>
                @error('topbar_center_text')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isHidden" class="form-label">Ẩn</label>
                <select class="form-select" id="isHidden" name="isHidden">
                    <option value="0" {{ old('isHidden', $topBar->isHidden) ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ old('isHidden', $topBar->isHidden) ? 'selected' : '' }}>Có</option>
                </select>
                @error('isHidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.top_bars.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
