@extends('admin.dashboard.layout')

@section('title', 'Thêm mới Vị trí Trống')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/vacancies/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Thêm mới Vị trí Trống</h2>

        <form action="{{ route('admin.vacancies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.vacancies.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
