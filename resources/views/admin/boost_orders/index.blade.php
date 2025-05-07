@extends('admin.dashboard.layout')

@section('title', 'Đơn hàng nổi bật')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/boost_orders/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách đơn hàng nổi bật</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.boost_orders.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm..." value="{{ request('keyword') }}" />
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <a href="{{ route('admin.boost_orders.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Nhà tuyển dụng</th>
                <th>Gói</th>
                <th>Giá gói</th>
                <th>Mã giao dịch</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Ngày mua</th>
                <th>Ngày hết hạn</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($boostOrders as $key => $order)
                <tr>
                    <td>{{ $boostOrders->firstItem() + $key }}</td>
                    <td>
                        {{ $order->employer ? $order->employer->firstname . ' ' . $order->employer->lastname : 'Không rõ' }}
                    </td>
                    <td>{{ $order->package->name ?? 'Không rõ' }}</td>
                    <td>{{ $order->package->price ?? 'Không rõ' }}</td>
                    <td>{{ $order->tnxID }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->isActive ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                    <td>{{ $order->date_purchased }}</td>
                    <td>{{ $order->date_expired }}</td>
                    <td>
                        <a href="{{ route('admin.boost_orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.boost_orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10" class="text-center">Không có dữ liệu</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $boostOrders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
