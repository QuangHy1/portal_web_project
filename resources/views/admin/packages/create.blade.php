@extends('admin.dashboard.layout')

@section('title', 'Tạo gói mới')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/packages/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>Tạo gói mới</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.packages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="duration">Thời hạn</label>
                <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required min="1">
            </div>
            <div class="form-group">
                <label for="duration_type">Đơn vị thời gian</label>
                <select class="form-control" id="duration_type" name="duration_type" required>
                    <option value="day" {{ old('duration_type') == 'day' ? 'selected' : '' }}>Ngày</option>
                    <option value="month" {{ old('duration_type') == 'month' ? 'selected' : '' }}>Tháng</option>
                    <option value="year" {{ old('duration_type') == 'year' ? 'selected' : '' }}>Năm</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jobs_count">Số lượng tin</label>
                <input type="number" class="form-control" id="jobs_count" name="jobs_count" value="{{ old('jobs_count') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="featured_count">Số lượng tin nổi bật</label>
                <input type="number" class="form-control" id="featured_count" name="featured_count" value="{{ old('featured_count') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="photos_count">Số lượng ảnh</label>
                <input type="number" class="form-control" id="photos_count" name="photos_count" value="{{ old('photos_count') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="videos_count">Số lượng video</label>
                <input type="number" class="form-control" id="videos_count" name="videos_count" value="{{ old('videos_count') }}" required min="0">
            </div>
            <div class="form-group">
                <label for="button">Button</label>
                <input type="text" class="form-control" id="button" name="button" value="{{ old('button') }}">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
@endsection

