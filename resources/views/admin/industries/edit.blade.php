@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Lĩnh vực')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/industries/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Lĩnh vực</h2>

        <form action="{{ route('admin.industries.update', $industry->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $industry->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.industries.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
