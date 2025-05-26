@extends('Frontend.layouts.masterDashboard')
@section('page_title')
    Giao Dich Boost
@endsection
@section('header_shadow')
    head-shadow
@endsection
@section('body_content')
    @include('Frontend.layouts.employerDashboardNav')
    <style>
        .card {
            border: none;
        }
        .modal-backdrop.show {
            z-index: -1 !important;
        }
        .modal.show {
            z-index: 1050 !important;
            display: block;
        }
    </style>
    @if(isset($activeBoost))
        <div class="alert alert-warning">
            Bạn hiện đang có gói boost hoạt động đến {{ \Carbon\Carbon::parse($activeBoost->date_expired)->format('d/m/Y') }}.
            <br>
            Mua gói mới sẽ thay thế gói hiện tại. Vui lòng xác nhận kỹ!
        </div>
    @endif
    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Giao Dịch Boost</h1>
                </div>
            </div>
        </div>

        <div class="dashboard-widg-bar d-block">
            <p>
                @if(isset($hiring))
                    Bạn đang boost cho tin tuyển dụng: <strong>{{ $hiring->title }}</strong>
                @else
                    Bạn đang mua gói boost cho tài khoản của bạn.
                @endif
            </p>
            @if(isset($hiring))
                <div class="bg-white rounded px-3 py-4 mb-4">
                    <p>Thông tin tin tuyển dụng:</p>
                    <div class="jbd-01 d-flex align-items-center justify-content-between">
                        <div class="jbd-flex d-flex align-items-center justify-content-start">
                            <div class="jbd-01-thumb">
                                <img src="{{ asset('uploads/companies/' . ($hiring->company->logo ?? 'default.png')) }}" class="img-fluid" width="90" alt="Logo công ty" />
                            </div>
                            <div class="jbd-01-caption pl-3">
                                <div class="tbd-title"><h4 class="mb-0 ft-medium fs-md">{{ $hiring->title }}</h4></div>
                                <div class="jbl_location mb-3">
                                    <span><i class="lni lni-map-marker mr-1"></i>{{ $hiring->location->name ?? 'Không xác định' }}</span>
                                    <span class="medium ft-medium text-warning ml-3">{{ $hiring->jobType->name ?? 'Không xác định' }}</span>
                                </div>
                                <div class="jbl_info01">
                                    @php
                                        $tags = $hiring->tags ?? '';
                                        $tag_array = array_filter(explode(',', $tags));
                                    @endphp
                                    @foreach($tag_array as $tag)
                                        <span class="px-2 py-1 ft-medium medium rounded text-purple bg-light-purple">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="jbd-01-right text-right hide-1023">
                            <div class="jbl_button"><a href="{{ route('jobs', $hiring->id) }}" class="btn rounded bg-white border fs-sm ft-medium">Chi Tiết</a></div>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('employer.boost.order') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Boost Settings -->
                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-gravity-list with-icons">
                            <h4 class="mb-0 ft-medium">Cấu Hình Gói Boost</h4>
                            <div class="card border-none">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="package_id" class="form-label">Chọn gói boost</label>
                                        <select id="package_id" name="package_id" class="form-control" required>
                                            <option value="">-- Chọn gói --</option>
                                            @foreach($packages as $package)
                                                <option value="{{ $package->id }}"
                                                        data-name="{{ $package->name }}"
                                                        data-duration="{{ $package->duration }}"
                                                        data-duration-type="{{ $package->duration_type }}"
                                                        data-price="{{ $package->price }}"
                                                        data-jobs-count="{{ $package->jobs_count }}">
                                                    {{ $package->name }} ({{ $package->duration }} {{ $package->duration_type }}) - {{ number_format($package->price) }} VNĐ
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tên gói:</label>
                                        <input type="text" id="package_name" class="form-control" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Giá gói:</label>
                                        <input type="text" id="package_price" class="form-control" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Số tin boost:</label>
                                        <input type="text" id="package_jobs_count" class="form-control" readonly>
                                    </div>

{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">Số lượng mua:</label>--}}
{{--                                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>--}}
{{--                                    </div>--}}

                                    <div class="mb-3">
                                        <label class="form-label">Thời hạn sử dụng:</label>
                                        <input type="text" id="package_duration" class="form-control" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ngày mua:</label>
                                        <input type="text" class="form-control" value="{{ now()->format('d/m/Y') }}" disabled>
                                        <input type="hidden" name="date_purchased" value="{{ now()->format('Y-m-d') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ngày hết hạn:</label>
                                        <input type="text" id="expired_date" name="date_expired" class="form-control" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tổng giá:</label>
                                        <input type="text" id="total_price_display" class="form-control" readonly>
                                        <input type="hidden" name="total_price" id="total_price" value="">
                                    </div>

                                    <input type="hidden" name="tnxID" id="tnxID" value="">

                                    <div class="mt-3">
                                        <p><strong>⚠️ Lưu ý:</strong> Boost giúp tăng hiển thị tin tuyển dụng. Giao dịch không hoàn tiền. Vui lòng cân nhắc kỹ trước khi mua.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-gravity-list invoices with-icons">
                            <div class="card border-none">
                                <div class="card-body text-center">
                                    <h4 class="mb-3 ft-medium">Thanh toán qua VietQR</h4>
                                    <p>Chọn thanh toán bằng VietQR để hoàn tất đơn hàng</p>

                                    <!-- ✅ Ảnh logo VietQR đẹp và nổi bật -->
                                    <img src="{{ asset('frontEndAssets/img/vietqr.png') }}"
                                         alt="VietQR Logo"
                                         style="
                                                max-width: 180px;
                                                height: auto;
                                                display: block;
                                                margin: 15px auto;
                                                border: 1px solid #ddd;
                                                border-radius: 8px;
                                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                                             ">

                                    <!-- ✅ Nút thanh toán -->
                                    <button type="button" class="btn btn-info mt-3" id="vietqr-pay-btn">
                                        Thanh toán bằng VietQR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal xác nhận thanh toán -->
                    <div class="modal fade" id="confirmVietQRModal" tabindex="-1" role="dialog" aria-labelledby="confirmVietQRModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xác nhận thanh toán đơn hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn thanh toán đơn hàng này không?</p>
                                    <ul class="list-unstyled">
                                        <li><strong>Gói Boost:</strong> <span id="modal-package-name"></span></li>
                                        <li><strong>Số tin boost:</strong> <span id="modal-jobs-count"></span></li>
                                        <li><strong>Thời hạn:</strong> <span id="modal-duration"></span></li>
                                        <li><strong>Tổng tiền:</strong> <span id="modal-total-price"></span> VND</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Trở về</button>
                                    <button type="button" class="btn btn-primary" id="confirm-vietqr-submit-btn">Xác nhận thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- JS Script -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                const packageSelect = document.getElementById('package_id');
                const nameInput = document.getElementById('package_name');
                const durationInput = document.getElementById('package_duration');
                const priceInput = document.getElementById('package_price');
                const countInput = document.getElementById('package_jobs_count');
                const expiredInput = document.getElementById('expired_date');
                const totalPriceInput = document.getElementById('total_price');

                // Sinh mã giao dịch ngẫu nhiên
                document.getElementById('tnxID').value = 'TNX-' + Math.random().toString(36).substr(2, 9).toUpperCase();

                function updateTotalPrice() {
                    const selected = packageSelect.options[packageSelect.selectedIndex];
                    const price = parseFloat(selected.getAttribute('data-price')) || 0;

                    priceInput.value = new Intl.NumberFormat().format(price) + ' VNĐ';
                    document.getElementById("total_price_display").value = new Intl.NumberFormat().format(price) + ' VNĐ';
                    totalPriceInput.value = price;
                }

                packageSelect.addEventListener('change', function () {
                    const selected = this.options[this.selectedIndex];

                    const name = selected.getAttribute('data-name');
                    const duration = parseInt(selected.getAttribute('data-duration'));
                    const durationType = selected.getAttribute('data-duration-type');
                    // const price = parseFloat(selected.getAttribute('data-price')) || 0;
                    const jobsCount = selected.getAttribute('data-jobs-count');

                    nameInput.value = name;
                    countInput.value = jobsCount;

                    // Việt hóa durationType
                    let durationTypeVN = '';
                    if (durationType === 'day') {
                        durationTypeVN = 'ngày';
                    } else if (durationType === 'week') {
                        durationTypeVN = 'tuần';
                    } else if (durationType === 'month') {
                        durationTypeVN = 'tháng';
                    } else if (durationType === 'year') {
                        durationTypeVN = 'năm';
                    }
                    durationInput.value = duration + ' ' + durationTypeVN;

                    const now = new Date();
                    let expiredDate = new Date(now);

                    if (durationType === 'day') {
                        expiredDate.setDate(now.getDate() + duration);
                    } else if (durationType === 'week') {
                        expiredDate.setDate(now.getDate() + duration * 7);
                    } else if (durationType === 'month') {
                        expiredDate.setMonth(now.getMonth() + duration);
                    } else if (durationType === 'year') {
                        expiredDate.setFullYear(now.getFullYear() + duration);
                    }

                    expiredInput.value = expiredDate.toLocaleDateString('vi-VN');

                    updateTotalPrice();
                });
            </script>

            <script>
                const vietqrRoute = "{{ route('employer.vietqr') }}";

                document.addEventListener("DOMContentLoaded", function () {
                    const vietqrPayBtn = document.getElementById("vietqr-pay-btn");
                    const confirmBtn = document.getElementById("confirm-vietqr-submit-btn");

                    vietqrPayBtn.addEventListener("click", function () {
                        const packageId = document.getElementById("package_id").value;
                        if (!packageId) {
                            alert("Vui lòng chọn gói boost trước khi thanh toán.");
                            return;
                        }

                        const packageName = document.getElementById("package_name").value;
                        const jobsCount = document.getElementById("package_jobs_count").value;
                        const durationText = document.getElementById("package_duration").value;
                        const totalPrice = document.getElementById("total_price").value;

                        document.getElementById("modal-package-name").textContent = packageName;
                        document.getElementById("modal-jobs-count").textContent = jobsCount;
                        document.getElementById("modal-duration").textContent = durationText;
                        document.getElementById("modal-total-price").textContent = totalPrice;

                        $('#confirmVietQRModal').modal('show');
                    });

                    confirmBtn.addEventListener("click", function () {
                        const totalPrice = document.getElementById("total_price").value;
                        const packageId = document.getElementById("package_id").value;
                        const jobsCount = document.getElementById("package_jobs_count").value;

                        if (isNaN(totalPrice) || isNaN(jobsCount)) {
                            alert("Thông tin thanh toán không hợp lệ.");
                            return;
                        }

                        const txnID = "TXN" + Date.now();

                        const redirectUrl = `${vietqrRoute}?amount=${encodeURIComponent(totalPrice)}&package_id=${encodeURIComponent(packageId)}&jobs_count=${encodeURIComponent(jobsCount)}&tnxID=${encodeURIComponent(txnID)}`;

                        window.location.href = redirectUrl;
                    });
                });
            </script>
@endsection

