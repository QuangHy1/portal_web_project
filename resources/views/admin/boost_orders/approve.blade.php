@extends('admin.dashboard.layout')

@section('title', 'Duyệt giao dịch boost')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/boost_orders/approve.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Duyệt các đơn boost chưa được kích hoạt</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($pendingOrders->isEmpty())
            <div class="alert alert-info">Không có đơn hàng nào đang chờ duyệt.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Nhà tuyển dụng</th>
                    <th>Gói</th>
                    <th>Giá gói</th>
                    <th>Mã giao dịch</th>
                    <th>Ngày mua</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pendingOrders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->employer->firstname ?? '' }} {{ $order->employer->lastname ?? '' }}</td>
                        <td>{{ $order->package->name ?? '—' }}</td>
                        <td>{{ number_format($order->package->price ?? 0) }} VNĐ</td>
                        <td>{{ $order->tnxID }}</td>
                        <td>{{ $order->date_purchased }}</td>
                        <td>
                            {{-- Duyệt --}}
                            <form action="{{ route('admin.boost_orders.approve', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn duyệt giao dịch này?')">Duyệt</button>
                            </form>

                            {{-- Từ chối --}}
                            <form action="{{ route('admin.boost_orders.reject', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn từ chối giao dịch này?')">Từ chối</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('admin.boost_orders.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
    </div>
@endsection
