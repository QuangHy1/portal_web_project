@extends('admin.dashboard.layout')
@section('title', 'Thêm công ty')

@section('content')
    <div class="container">
        <h2>Thêm công ty</h2>
        <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Tên công ty</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email công ty</label>
                <input type="text" name="company_email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Vị trí</label>
                <input type="text" name="location" class="form-control">
            </div>
            <div class="mb-3">
                <label>Website</label>
                <input type="url" name="website" class="form-control">
            </div>
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label>Logo công ty</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
            </div>
            <button class="btn btn-primary">Thêm</button>
            <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
