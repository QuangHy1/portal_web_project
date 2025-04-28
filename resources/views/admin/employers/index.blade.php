@extends('admin.dashboard.layout')

@section('title', 'Quản lý Nhà tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employers/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Nhà tuyển dụng</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.employers.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm nhà tuyển dụng..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.employers.create') }}" class="btn btn-success">
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
                    <th>Tên</th>
                    <th>Công ty</th>
                    <th>Địa điểm</th>
                    <th>Lĩnh vực</th>
                    <th>Điện thoại</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Đình chỉ</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employers as $employer)
                    <tr>
                        <td>{{ $employer->id }}</td>
                        <td>{{ $employer->firstname }} {{ $employer->lastname }}</td>
                        <td>{{ $employer->company->name ?? 'N/A' }}</td>
                        <td>{{ $employer->location->name ?? 'N/A' }}</td>
                        <td>{{ $employer->industry->name ?? 'N/A' }}</td>
                        <td>{{ $employer->phone }}</td>
                        <td>
                            @if ($employer->gender == 'male')
                                Nam
                            @elseif ($employer->gender == 'female')
                                Nữ
                            @else
                                Khác
                            @endif
                        </td>
                        <td>{{ $employer->date_of_birth }}</td>
                        <td>
                            @if ($employer->isSuspended == 'yes')
                                Có
                            @else
                                Không
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.employers.edit', $employer->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.employers.destroy', $employer->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $employers->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
