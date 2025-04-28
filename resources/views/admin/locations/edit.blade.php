@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Địa điểm')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/locations/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Địa điểm</h2>

        <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $location->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
