@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
@include('Frontend.layouts.employerDashboardNav')
        <div class="dashboard-content">
            <div class="dashboard-tlbar d-block mb-5">
                <div class="row">
                    <div class="colxl-12 col-lg-12 col-md-12">
                        <h1 class="ft-medium">
                            Hello, {{ Auth::guard('employer')->user()->employer->firstname }} {{ Auth::guard('employer')->user()->employer->lastname }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-muted"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#" class="theme-cl">Dashboard</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="dashboard-widg-bar d-block">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="dash-widgets py-5 px-4 bg-success rounded">
                            <h2 class="ft-medium mb-1 fs-xl text-light">{{ $totalJobPosted }}</h2>
                            <p class="p-0 m-0 text-light fs-md">Tổng Tin Đã Thêm</p>
                            <i class="lni lni-empty-file"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="dash-widgets py-5 px-4 bg-purple rounded">
                            <h2 class="ft-medium mb-1 fs-xl text-light">{{ $totalActiveJob }}</h2>
                            <p class="p-0 m-0 text-light fs-md">Tin Đang Được Đăng</p>
                            <i class="lni lni-users"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="dash-widgets py-5 px-4 bg-danger rounded">
                            <h2 class="ft-medium mb-1 fs-xl text-light">{{ $totalExpiredJob }}</h2>
                            <p class="p-0 m-0 text-light fs-md">Tin Đã Quá Hạn</p>
                            <i class="lni lni-bar-chart"></i>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="dash-widgets py-5 px-4 bg-blue rounded">
                            <h2 class="ft-medium mb-1 fs-xl text-light">{{ $totalBoostedJob }}</h2>
                            <p class="p-0 m-0 text-light fs-md">Tin được BOOST</p>
                            <i class="lni lni-heart"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- <div class="col-lg-6 col-md-12">
                        <div class="dashboard-gravity-list with-icons">
                            <h4 class="mb-0 ft-medium">Recent Activities</h4>
                            <ul>
                                <li>
                                    <i class="dash-icon-box ti-layers text-purple bg-light-purple"></i> Your job for <strong class="ft-medium text-dark"><a href="#">IOS Developer</a></strong> has been approved!
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-star text-success bg-light-success"></i> Jodie Farrell left a review <div class="numerical-rating high" data-rating="5.0"></div> for<strong class="ft-medium text-dark"><a href="#"> Real Estate Logo</a></strong>
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-heart text-warning bg-light-warning"></i> Someone bookmarked your <strong class="ft-medium text-dark"><a href="#">SEO Expert Job</a></strong> listing!
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-star text-info bg-light-info"></i> Gracie Mahmood left a review <div class="numerical-rating mid" data-rating="3.8"></div> on <strong class="ft-medium text-dark"><a href="#">Product Design</a></strong>
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-heart text-danger bg-light-danger"></i> Your Magento Developer job expire<strong class="ft-medium text-dark"><a href="#">Renew</a></strong> now it!
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-star text-success bg-light-success"></i> Ethan Barrett left a review <div class="numerical-rating high" data-rating="4.7"></div> on <strong class="ft-medium text-dark"><a href="#">New Logo</a></strong>
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>

                                <li>
                                    <i class="dash-icon-box ti-star text-purple bg-light-purple"></i> Your Magento Developer job expire <strong class="ft-medium text-dark"><a href="#">Renew</a></strong> now it.
                                    <a href="#" class="close-list-item"><i class="fas fa-times"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-gravity-list invoices with-icons">
                            <h4 class="mb-0 ft-medium">Lịch Sử Giao Dịch</h4>
                            <ul class="payment-list">
                                @foreach($payments as $payment)
                                    <li class="payment-item d-flex p-3 shadow-sm rounded border">

                                        <!-- Nội dung -->
                                        <div class="payment-content">
                                            <strong class="ft-medium text-dark d-block mb-2">{{ $payment['payment_method'] }}</strong>
                                            <ul class="payment-info list-unstyled mb-0">
                                                <li class="text-success font-weight-bold">Đã thanh toán</li><br>
                                                <li>Mã giao dịch (ID): #{{ $payment['tnxID'] }}</li><br>
                                                <li>Thời Gian: {{ $payment['date_purchased'] }}</li><br>
                                                <li>Giá gói: {{ $payment->package_price }}</li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

@endsection
