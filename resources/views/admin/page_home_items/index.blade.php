@extends('admin.dashboard.layout')

@section('title', 'Quản lý Trang chủ')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/page_home_items/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Trang chủ</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.page_home_items.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm..." value="{{ $keyword ?? '' }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.page_home_items.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Job Placeholder</th>
                    <th>Job Button</th>
                    <th>Location Placeholder</th>
                    <th>Category Placeholder</th>
                    <th>Job Category Heading</th>
                    <th>Job Category Description</th>
                    <th>Job Category Status</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pageHomeItems as $pageHomeItem)
                    <tr>
                        <td>{{ $pageHomeItem->id }}</td>
                        <td>{{ $pageHomeItem->heading }}</td>
                        <td>{{ $pageHomeItem->description }}</td>
                        <td>
                            @if ($pageHomeItem->image)
                                <img src="{{ asset('uploads/page_home_items/' . $pageHomeItem->image) }}" alt="Image"
                                     style="max-width: 80px; max-height: 60px;">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                        <td>{{ $pageHomeItem->job_placeholder }}</td>
                        <td>{{ $pageHomeItem->job_button }}</td>
                        <td>{{ $pageHomeItem->location_placeholder }}</td>
                        <td>{{ $pageHomeItem->category_placeholder }}</td>
                        <td>{{ $pageHomeItem->job_category_heading }}</td>
                        <td>{{ $pageHomeItem->job_category_description }}</td>
                        <td>{{ $pageHomeItem->job_category_status }}</td>
                        <td>{{ $pageHomeItem->created_at ? $pageHomeItem->created_at->format('d/m/Y H:i:s') : '' }}</td>
                        <td>{{ $pageHomeItem->updated_at ? $pageHomeItem->updated_at->format('d/m/Y H:i:s') : '' }}</td>
                        <td>
                            <a href="{{ route('admin.page_home_items.edit', $pageHomeItem->id) }}"
                               class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.page_home_items.destroy', $pageHomeItem->id) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="d-flex justify-content-center">
            {{ $pageHomeItems->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
