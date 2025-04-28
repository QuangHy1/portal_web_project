@extends('admin.dashboard.layout')
@section('title', 'Danh sách công ty')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/companies/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách Công Ty</h2>

        <!-- Thanh tìm kiếm & nút thêm -->
        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Ô tìm kiếm -->
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.companies.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm công ty..." value="{{ request('keyword') }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <!-- Nút thêm -->
            <a href="{{ route('admin.companies.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên công ty</th>
                <th>Email công ty</th>
                <th>Vị trí</th>
                <th>Website</th>
                <th>Mô tả</th>
                <th>Logo</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse($companies as $key => $company)
                <tr>
                    <td>{{ $companies->firstItem() + $key }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->company_email}}</td>
                    <td>{{ $company->location }}</td>
                    <td>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                        @else
                            <span class="text-muted">Không có</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($company->description, 50) }}</td>
                    <td>
                        @if($company->logo)
                            <img src="{{ asset('uploads/companies/' . $company->logo) }}" alt="Logo" class = "logo-img">
                        @else
                            <span class="text-muted">Không có logo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Không có công ty nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Thanh phân trang -->
        <div class="d-flex justify-content-center">
            {{ $companies->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

