@extends('admin.dashboard.layout')

@section('title', 'Gói')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/packages/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách gói</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.packages.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm gói..." value="{{ request('keyword') }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <a href="{{ route('admin.packages.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Thời hạn</th>
                <th>Đơn vị thời gian</th>
                <th>Số lượng tin</th>
                <th>Số lượng tin nổi bật</th>
                <th>Số lượng ảnh</th>
                <th>Số lượng video</th>
                <th>Button</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($packages as $key => $package)
                <tr>
                    <td>{{ $packages->firstItem() + $key }}</td>
                    <td>{{ $package->name }}</td>
                    <td>{{ $package->price }}</td>
                    <td>{{ $package->duration }}</td>
                    <td>
                        @switch($package->duration_type)
                            @case('day')
                                Ngày
                                @break
                            @case('month')
                                Tháng
                                @break
                            @case('year')
                                Năm
                                @break
                            @default
                                Không rõ
                        @endswitch
                    </td>
                    <td>{{ $package->jobs_count }}</td>
                    <td>{{ $package->featured_count }}</td>
                    <td>{{ $package->photos_count }}</td>
                    <td>{{ $package->videos_count }}</td>
                    <td>{{ $package->button }}</td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Không tìm thấy gói nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $packages->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
