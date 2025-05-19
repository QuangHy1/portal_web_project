{{--<!DOCTYPE html>--}}
{{--<html lang="zxx">--}}

{{--<head>--}}
{{--    <meta name="title" content="JobScout - Your Ultimate Job Portal App">--}}
{{--    <meta name="description"--}}
{{--          content="JobScout is an advance job portal application that helps job seekers find employment opportunities that match their skills, interests, and experience.">--}}
{{--    <meta name="keywords"--}}
{{--          content="job portal, job search, employment opportunities, resume builder, job search tips, networking, job interviews, salary negotiation, job openings">--}}
{{--    <meta name="robots" content="index, follow">--}}
{{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">--}}
{{--    <meta name="language" content="English">--}}
{{--    <meta name="revisit-after" content="2 days">--}}
{{--    <meta name="author" content="JobScout">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <title>@yield('page_title') - JobScout</title>--}}
{{--    <!-- Boxicons -->--}}
{{--    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>--}}
{{--    <!-- Custom CSS -->--}}
{{--    <link href="{{ asset('frontEndAssets/css/styles.css') }}" rel="stylesheet">--}}
{{--    @livewireScripts @livewireStyles--}}
{{--</head>--}}

{{--<body>--}}

{{--<!-- ============================================================== -->--}}
{{--<!-- Preloader - style you can find in spinners.css -->--}}
{{--<!-- ============================================================== -->--}}
{{--<div class="preloader"></div>--}}

{{--<!-- ============================================================== -->--}}
{{--<!-- Main wrapper - style you can find in pages.scss -->--}}
{{--<!-- ============================================================== -->--}}
{{--<div id="main-wrapper">--}}

{{--    <!-- ============================================================== -->--}}
{{--    <!-- Top header  -->--}}
{{--    <!-- ============================================================== -->--}}
{{--    @php--}}
{{--        $topbarData = App\Models\Topbar::first();--}}
{{--    @endphp--}}
{{--    @if ($topbarData->isHidden == 0)--}}
{{--        <div class="py-2 bg-dark">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">--}}
{{--                        <div class="top_first"><a href="callto:{{ $topbarData['topbar_contact'] }}"--}}
{{--                                                  class="medium text-light">{{ $topbarData['topbar_contact'] }}</a></div>--}}
{{--                    </div>--}}

{{--                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">--}}
{{--                        <div class="top_second text-center">--}}
{{--                            <p class="medium text-light m-0 p-0">{{ $topbarData['topbar_center_text'] }} </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Right Menu -->--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">--}}
{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            @if (Auth::guard('employee')->check())--}}
{{--                                <a href="{{ route('employee.logout') }}" class="text-light medium">Log Out</a>--}}
{{--                            @elseif(Auth::guard('employer')->check())--}}
{{--                                <a href="{{ route('employer.logout') }}" class="text-light medium">Log Out</a>--}}
{{--                            @else--}}

{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            <a href="{{ route('employee.job.bookmarks') }}" class="text-light medium">Wishlist</a>--}}
{{--                        </div>--}}

{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            @if (Auth::guard('employee')->check())--}}
{{--                                <a href="{{ route('employee.dashboard') }}"--}}
{{--                                   class="text-light medium">{{ auth()->guard('employee')->user()->firstname .' ' .Auth::guard('employee')->user()->lastname }}</a>--}}
{{--                            @elseif(Auth::guard('employer')->check())--}}
{{--                                <a href="{{ route('employer.dashboard') }}"--}}
{{--                                   class="text-light medium">{{ auth()->guard('employer')->user()->employer_name }}</a>--}}
{{--                            @else--}}
{{--                                <a href="{{ route('employee.dashboard') }}" data-toggle="modal" data-target="#login"--}}
{{--                                   class="text-light medium">My Account</a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Right Menu -->--}}
{{--                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">--}}
{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            --}}{{-- @if (Auth::guard('employee')->check())--}}
{{--                                <a href="{{ route('employee.logout') }}" class="text-light medium">Log Out</a>--}}
{{--                            @elseif(Auth::guard('employer')->check())--}}
{{--                                <a href="{{ route('employer.logout') }}" class="text-light medium">Log Out</a>--}}
{{--                            @else --}}
{{--                            <a href="javascript:void(0);" class="text-light medium">Log Out</a> --}}{{----}}{{-- TODO: mở lại khi Auth xong --}}
{{--                            --}}{{-- @endif --}}
{{--                        </div>--}}

{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            <a href="javascript:void(0);" class="text-light medium">Danh sách ước</a> --}}{{-- TODO: sau nối route --}}
{{--                        </div>--}}

{{--                        <div class="currency-selector dropdown js-dropdown float-right mr-3">--}}
{{--                            --}}{{-- @if (Auth::guard('employee')->check())--}}
{{--                                <a href="{{ route('employee.dashboard') }}" class="text-light medium">{{ auth()->guard('employee')->user()->firstname .' ' .Auth::guard('employee')->user()->lastname }}</a>--}}
{{--                            @elseif(Auth::guard('employer')->check())--}}
{{--                                <a href="{{ route('employer.dashboard') }}" class="text-light medium">{{ auth()->guard('employer')->user()->employer_name }}</a>--}}
{{--                            @else --}}
{{--                            <a href="javascript:void(0);" class="text-light medium">Tài khoản</a> --}}{{-- TODO: mở sau --}}
{{--                            --}}{{-- @endif --}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
{{--    @endif--}}
{{--    <!-- Start Navigation -->--}}
{{--    <div class="header header-light dark-text @yield('header_shadow')">--}}
{{--        <div class="container">--}}
{{--            <nav id="navigation" class="navigation navigation-landscape">--}}
{{--                <div class="nav-header">--}}
{{--                    <a class="nav-brand" href="{{ route('home') }}">--}}
{{--                        <img src="{{ asset('frontEndAssets/img/jobscout.png') }}" class="logo" alt="" />--}}
{{--                    </a>--}}
{{--                    <div class="nav-toggle"></div>--}}
{{--                    <div class="mobile_nav">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#" data-toggle="modal" data-target="#login" class="theme-cl fs-lg">--}}
{{--                                    <i class="lni lni-user"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @if (Auth::guard('employee')->check())--}}
{{--                                <li>--}}
{{--                                    <a href="{{ route('job.search') }}"--}}
{{--                                       class="crs_yuo12 w-auto text-white theme-bg">--}}
{{--                                            <span class="embos_45"><i class="fas fa-plus-circle mr-1 mr-1"></i>Post--}}
{{--                                                Job</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @else--}}
{{--                                <li>--}}
{{--                                    <a href="{{ route('employer.hiring.view') }}"--}}
{{--                                       class="crs_yuo12 w-auto text-white theme-bg">--}}
{{--                                            <span class="embos_45"><i--}}
{{--                                                    class="fas fa-plus-circle mr-1 mr-1"></i>Apply</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="nav-menus-wrapper" style="transition-property: none;">--}}
{{--                    @include('Frontend.layouts.nav')--}}
{{--                    <ul class="nav-menu nav-menu-social align-to-right">--}}
{{--                        @if (Auth::guard('employer')->check())--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('employer.dashboard') }}" class="ft-medium">--}}
{{--                                    <i class="lni lni-dashboard mr-2"></i>Dashboard--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @elseif(Auth::guard('employee')->check())--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('employee.dashboard') }}" class="ft-medium">--}}
{{--                                    <i class="lni lni-dashboard mr-2"></i>Dashboard--}}
{{--                                </a>--}}
{{--                        @else--}}
{{--                            <li>--}}
{{--                                <a href="#" data-toggle="modal" data-target="#login" class="ft-medium">--}}
{{--                                    <i class="lni lni-user mr-2"></i>Đăng nhập ngay--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if (Auth::guard('employee')->check())--}}
{{--                            <li class="add-listing theme-bg">--}}
{{--                                <a href="{{ route('job.search') }}">--}}
{{--                                    <i class="lni lni-circle-plus mr-1"></i> Apply For Job--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @else--}}
{{--                            <li class="add-listing theme-bg">--}}
{{--                                <a href="{{ route('employer.hiring.view') }}">--}}
{{--                                    <i class="lni lni-circle-plus mr-1"></i> Đăng tin tuyển dụng--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                    <ul class="nav-menu nav-menu-social align-to-right">--}}
{{--                         @if (Auth::guard('employer')->check())--}}
{{--                         <li><a href="{{ route('employer.dashboard') }}" class="ft-medium"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>--}}
{{--                        --}}{{-- @elseif(Auth::guard('employee')->check()) --}}
{{--                        --}}{{-- <li><a href="{{ route('employee.dashboard') }}" class="ft-medium"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li> --}}
{{--                         @else--}}
{{--                        <li><a href="{{ route('employer.signin') }}">--}}
{{--                                <i class="lni lni-circle-plus mr-1"></i> Đăng Tin--}}
{{--                            </a></li> --}}{{-- TODO: Mở modal login sau --}}
{{--                         @endif--}}

{{--                        --}}{{-- @if (Auth::guard('employee')->check()) --}}
{{--                        --}}{{-- <li class="add-listing theme-bg"><a href="{{ route('job.search') }}"><i class="lni lni-circle-plus mr-1"></i> Apply For Job</a></li> --}}
{{--                        --}}{{-- @else --}}
{{--                        <li class="add-listing theme-bg">--}}
{{--                            <a href="javascript:void(0);"><i class="lni lni-circle-plus mr-1"></i> Đăng Tin</a> --}}{{-- TODO: mở route sau --}}
{{--                        </li>--}}
{{--                        --}}{{-- @endif --}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Navigation -->--}}
{{--    <div class="clearfix"></div>--}}
    <!DOCTYPE html>
<html lang="zxx">
<head>
    <meta name="title" content="JobScout - Your Ultimate Job Portal App">
    <meta name="description"
          content="JobScout is an advance job portal application that helps job seekers find employment opportunities that match their skills, interests, and experience.">
    <meta name="keywords"
          content="job portal, job search, employment opportunities, resume builder, job search tips, networking, job interviews, salary negotiation, job openings">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="JobScout">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('page_title') - JobScout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href="{{ asset('frontEndAssets/css/styles.css') }}" rel="stylesheet">
</head>

<body>
<div class="preloader"></div>
<div id="main-wrapper">

    <!-- ========== START TOPBAR ========== -->
    @php $topbarData = App\Models\Topbar::first(); @endphp
    @if ($topbarData && $topbarData->isHidden == 0)
        <div class="py-2 bg-dark">
            <div class="container">
                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                        <div class="top_first">
                            <a href="callto:{{ $topbarData->topbar_contact }}" class="medium text-light">
                                {{ $topbarData->topbar_contact }}
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 hide-ipad">
                        <div class="top_second text-center">
                            <p class="medium text-light m-0 p-0">{{ $topbarData->topbar_center_text }}</p>
                        </div>
                    </div>

                    <!-- Right Menu -->
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12">
{{--                        <div class="currency-selector dropdown float-right mr-3">--}}
{{--                            <a href="javascript:void(0);" class="text-light medium">Danh sách ước</a>--}}
{{--                        </div>--}}

                        <div class="currency-selector dropdown js-dropdown float-right mr-3">
                            @if (Auth::guard('employee')->check())
                                <a href="{{ route('employee.logout') }}" class="text-light medium">Đăng Xuất</a>
                            @elseif(Auth::guard('employer')->check())
                                <a href="{{ route('employer.logout') }}" class="text-light medium">Đăng Xuất</a>
                            @else
                            @endif
                        </div>
                        @auth('employee')
                            <div class="currency-selector dropdown js-dropdown float-right mr-3">
                                <a href="{{ route('employee.job.bookmarks') }}" class="text-light medium">Danh Sách Ước</a>
                            </div>
                        @endauth
                        <div class="currency-selector dropdown float-right mr-3">
                            @auth('employee')
                                <a href="{{ route('employee.dashboard') }}" class="text-light medium">
                                    {{ auth('employee')->user()->employee->firstname . ' ' . auth('employee')->user()->employee->lastname }}
                                </a>
                            @elseauth('employer')
                                <a href="{{ route('employer.profile') }}" class="text-light medium">
                                    {{ auth('employer')->user()->username }}
                                </a>
                            @else
                                <a href="{{ route('employee.signin') }}" class="text-light medium">Tài khoản</a>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
    <!-- ========== END TOPBAR ========== -->

    <!-- ========== START NAVIGATION ========== -->
    <div class="header header-light dark-text @yield('header_shadow')">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <a class="nav-brand" href="{{ route('home') }}">
                        <img src="{{ asset('frontEndAssets/img/jobscout.png') }}" class="logo" alt="JobScout Logo" />
                    </a>
                    <div class="nav-toggle"></div>
                    <div class="mobile_nav">
                        <ul>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#login" class="theme-cl fs-lg">
                                    <i class="lni lni-user"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="nav-menus-wrapper">
                    @include('Frontend.layouts.nav')
                    <ul class="nav-menu nav-menu-social align-to-right">
                        @auth('employer')
                            <li>
                                <a href="{{ route('employer.dashboard') }}" class="ft-medium">
                                    <i class="lni lni-dashboard mr-2"></i>Dashboard
                                </a>
                            </li>
                        @elseif(auth('employee')->check())
                            <li>
                                <a href="{{ route('employee.dashboard') }}" class="ft-medium">
                                    <i class="lni lni-dashboard mr-2"></i>Dashboard
                                </a>
                            </li>
                        @else
                            <li class="add-listing theme-bg1">
                                <a href="{{ route('employee.signin') }}">
                                    <i class=" mr-1"></i> Đăng Nhập
                                </a>
                            </li>
                        @endauth

                            @auth('employer')
                                <li class="add-listing theme-bg">
                                    <a href="{{ route('employer.hiring.view') }}">
                                        <i class="lni lni-circle-plus mr-1"></i> Đăng Tin
                                    </a>
                                </li>
                            @elseif(auth('employee')->check())
                                <li class="add-listing theme-bg">
                                    <a href="{{ route('job.search') }}">
                                        <i class="lni lni-circle-plus mr-1"></i> Apply
                                    </a>
                                </li>
                            @else
                                <li class="add-listing theme-bg">
                                    <a href="{{ route('employer.signin') }}">
                                        <i class="lni lni-circle-plus mr-1"></i> Đăng Tin
                                    </a>
                                </li>
                            @endauth
{{--                        <li class="add-listing theme-bg">--}}
{{--                            <a href="{{ route('employer.signin') }}">--}}
{{--                                <i class="lni lni-circle-plus mr-1"></i> Đăng Tin--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ========== END NAVIGATION ========== -->

    <div class="clearfix"></div>
