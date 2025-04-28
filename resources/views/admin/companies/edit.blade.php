@extends('admin.dashboard.layout')
@section('title', 'Chỉnh sửa công ty')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/companies/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa: </h2>
        <h2 class="my-4 name">{{ $company->name }}</h2>
        <form action="{{ route('admin.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Tên công ty</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Email công ty</label>
                <input type="text" name="company_email" class="form-control" value="{{ old('name', $company->company_email) }}" required>
            </div>
            <div class="mb-3">
                <label>Vị trí</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $company->location) }}">
            </div>
            <div class="mb-3">
                <label>Website</label>
                <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
            </div>
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $company->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Logo công ty</label>

                @if($company->logo)
                    <div class="mb-2 d-flex align-items-center gap-3 logo">
                        <div class="img_logo" >
                            <img src="{{ asset('uploads/companies/' . $company->logo) }}" alt="Logo hiện tại" height="80">
                        </div>
                        <span>{{ $company->logo }}</span>
                    </div>
                @else
                    <p class="text-muted">Chưa có logo</p>
                @endif

                <input type="file" name="logo" class="form-control" accept="image/*">
                <small class="text-muted">Bỏ trống nếu không muốn thay đổi logo</small>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
