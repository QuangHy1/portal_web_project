@extends('Frontend.layouts.masterDashboard')
@section('page_title')
    #1 Job Portal Company
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
    </style>

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

            <div class="row">
                <!-- Boost Settings -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-gravity-list with-icons">
                        <h4 class="mb-0 ft-medium">Cài Đặt Gói Boost</h4>
                        <div class="card border-none">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <p class="card-text">Thời gian Boost:</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="boost-days" name="boost-days" class="form-control"
                                               min="1" max="7" value="1">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <p class="card-text">Giá gói:</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" disabled id="boost-price">
                                    </div>
                                </div>
                                <hr class="mt-5">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p><strong>Lưu ý:</strong> Boost là dịch vụ quảng cáo giúp tăng hiển thị tin tuyển dụng, không hoàn tiền và không cam kết kết quả. Vui lòng cân nhắc kỹ trước khi mua.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-gravity-list invoices with-icons">
                        <div class="card border-none">
                            <div class="card-body">
                                <h4 class="mb-0 ft-medium">Phương Thức Thanh Toán</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="https://techlekh.com/wp-content/uploads/2017/06/esewa-logo.png"
                                             class="img-fluid" alt="eSewa Logo">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                            <input value="100" name="tAmt" id="boost-price-esewas" type="hidden">
                                            <input value="100" name="amt" id="boost-price-esewa" type="hidden">
                                            <input value="0" name="txAmt" type="hidden">
                                            <input value="0" name="psc" type="hidden">
                                            <input value="0" name="pdc" type="hidden">
                                            <input value="EPAYTEST" name="scd" type="hidden">
                                            <input value="{{ isset($hiring) ? $hiring->id . '-' . uniqid() : 'purchase-' . uniqid() }}" name="pid" type="hidden">
                                            <input value="http://localhost/jobscout/public/verify/esewa_payment?q=su" type="hidden" name="su">
                                            <input value="http://localhost/jobscout/public/verify/esewa_payment?q=fu" type="hidden" name="fu">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Thanh toán bằng eSewa & Hoàn tất đơn hàng
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script cập nhật giá boost -->
        <script>
            const boostDaysSelect = document.getElementById('boost-days');
            const boostPriceInput = document.getElementById('boost-price');
            const boostPriceInputEsewa = document.getElementById('boost-price-esewa');
            const boostPriceInputEsewas = document.getElementById('boost-price-esewas');

            function updateBoostPrice() {
                const boostDays = parseInt(boostDaysSelect.value || 0);
                const boostPrice = boostDays * 100;
                boostPriceInput.value = 'Rs. ' + boostPrice;
                boostPriceInputEsewa.value = boostPrice;
                boostPriceInputEsewas.value = boostPrice;
            }

            boostDaysSelect.addEventListener('input', updateBoostPrice);
            updateBoostPrice(); // Khởi tạo khi load trang
        </script>

@endsection

