@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa đơn Boost')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/boost_orders/edit.css') }}">
    <style>
        input[readonly] {
            background-color: #e9ecef;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Chỉnh sửa đơn Boost</h2>

        <form action="{{ route('admin.boost_orders.update', $boostOrder->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="employer_id">Nhà tuyển dụng</label>
                <select class="form-control" id="employer_id" name="employer_id" required>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}" {{ $boostOrder->employer_id == $employer->id ? 'selected' : '' }}>
                            {{ $employer->firstname . ' ' . $employer->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="package_id">Gói</label>
                <select class="form-control" id="package_id" name="package_id" required>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}"
                                data-price="{{ $package->price }}"
                                data-duration="{{ $package->duration }}"
                                data-duration-type="{{ $package->duration_type }}"
                            {{ $boostOrder->package_id == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="package_price">Giá gói</label>
                <input type="text" class="form-control" id="package_price" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="tnxID">Mã giao dịch</label>
                <input type="text" class="form-control" id="tnxID" name="tnxID" value="{{ $boostOrder->tnxID }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="payment_method">Phương thức thanh toán</label>
                <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $boostOrder->payment_method }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="isActive">Kích hoạt?</label>
                <select class="form-control" id="isActive" name="isActive" required>
                    <option value="1" {{ $boostOrder->isActive ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ !$boostOrder->isActive ? 'selected' : '' }}>Không</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="date_purchased">Ngày mua</label>
                <input type="text" class="form-control" id="date_purchased" name="date_purchased" value="{{ $boostOrder->date_purchased }}" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="date_expired">Ngày hết hạn</label>
                <input type="text" class="form-control" id="date_expired" name="date_expired" value="{{ $boostOrder->date_expired }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.boost_orders.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection

@section('custom_js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const packageSelect = document.getElementById('package_id');
            const priceInput = document.getElementById('package_price');
            const datePurchasedInput = document.getElementById('date_purchased');
            const dateExpiredInput = document.getElementById('date_expired');

            function updateFields() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const duration = parseInt(selectedOption.getAttribute('data-duration'));
                const durationType = selectedOption.getAttribute('data-duration-type');

                priceInput.value = price || '';

                const purchasedDate = new Date(datePurchasedInput.value);
                let expiredDate = new Date(purchasedDate);

                if (!isNaN(duration)) {
                    switch (durationType) {
                        case 'day':
                            expiredDate.setDate(expiredDate.getDate() + duration);
                            break;
                        case 'month':
                            expiredDate.setMonth(expiredDate.getMonth() + duration);
                            break;
                        case 'year':
                            expiredDate.setFullYear(expiredDate.getFullYear() + duration);
                            break;
                    }
                }

                dateExpiredInput.value = expiredDate.toISOString().split('T')[0];
            }

            packageSelect.addEventListener('change', updateFields);
            updateFields();
        });
    </script>
@endsection
