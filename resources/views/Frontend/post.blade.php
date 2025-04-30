@extends('Frontend.layouts.master')

@section('page_title')
    {{ $blogPost->title }}
@endsection
@section('body_content')
    <section class="page-title gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap">
                        <h2 class="mb-0 ft-medium">{{ $blogPost->title }}</h2>
                            <nav class="transparent">
                                <ol class="breadcrumb p-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                                    <li class="breadcrumb-item active theme-cl" aria-current="page">{{ $blogPost->title }}
                                    </li>
                                </ol>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">

                <!-- Blog Detail -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="article_detail_wrapss single_article_wrap format-standard">
                        <div class="article_body_wrap">

                            <div class="article_featured_image">
                                <img class="img-fluid" src="{{ asset('frontEndAssets/img/' . $blogPost->image) }}"
                                    alt="">
                            </div>

                            <div class="article_top_info">
                                <ul class="article_middle_info">
                                    <li><a href="#"><span class="icons"><i
                                                    class="ti-time"></i></span>{{ $blogPost->created_at->format('d F, Y') }}</a>
                                    </li>
                                    <li><a href="#"><span class="icons"><i
                                                    class="ti-eye"></i></span>{{ $blogPost->view_count }} Views</a></li>
                                </ul>
                            </div>
                            <h2 class="post-title">{{ $blogPost->title }}</h2>
                            @php
                                $modified_content = $blogPost->content;

                                if (isset($jobDetails)) {
                                    $companyLogoUrl = $jobDetails->company && $jobDetails->company->logo
                                        ? asset('frontEndAssets/img/' . $jobDetails->company->logo)
                                        : '';

                                    $jobTitle = $jobDetails->title ?? '';
                                    $jobLocation = $jobDetails->location->name ?? '';
                                    $jobType = $jobDetails->jobType->name ?? '';
                                    $jobDetailUrl = $jobDetails->id ? route('jobs', $jobDetails->id) : '#';

                                    $tagsHtml = '';
                                    $tags = $jobDetails->tags ?? '';
                                    $tagArray = explode(',', $tags);
                                    foreach ($tagArray as $tag) {
                                        $tagsHtml .= '<span class="px-2 py-1 ml-1 ft-medium medium rounded text-purple bg-light-purple">' . trim($tag) . '</span>';
                                    }

                                    $adcode = '
                                        <div class="text-center mt-3"><sub class="text-center">--Advertisement--</sub></div>
                                        <div class="bg-light rounded px-3 py-4 mb-4">
                                            <div class="jbd-01 d-flex align-items-center justify-content-between mb-3">
                                                <div class="jbd-flex d-flex align-items-center justify-content-start">
                                                    <div class="jbd-01-thumb">
                                                        <img src="' . $companyLogoUrl . '" class="img-fluid" width="90" alt="" />
                                                    </div>
                                                    <div class="jbd-01-caption pl-3">
                                                        <div class="tbd-title"><h4 class="mb-0 ft-medium fs-md">' . $jobTitle . '</h4></div>
                                                        <div class="jbl_location mb-3">
                                                            <span><i class="lni lni-map-marker mr-1"></i>' . $jobLocation . '</span>
                                                            <span class="medium ft-medium text-warning ml-3">' . $jobType . '</span>
                                                        </div>
                                                        <div class="jbl_info01">' . $tagsHtml . '</div>
                                                    </div>
                                                </div>
                                                <div class="jbd-01-right text-right hide-1023">
                                                    <div class="jbl_button">
                                                        <a href="' . $jobDetailUrl . '" class="btn rounded bg-white border fs-sm ft-medium">More Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                    $paragraphs = explode('</p>', $blogPost->content);
                                    $second_paragraph = $paragraphs[2] ?? '';
                                    $modified_content = str_replace($second_paragraph . '</p>', $second_paragraph . '</p>' . $adcode, $blogPost->content);
                                }
                            @endphp
                            {!! $modified_content !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-12">

                    <!-- Searchbard -->
                    <div class="single_widgets widget_search">
                        <h4 class="title">Tìm Kiếm</h4>
                        <form action="#" class="sidebar-search-form">
                            <input type="search" name="search" placeholder="Tìm..">
                            <button type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="single_widgets widget_category">
                        <h4 class="title">Thể Loại</h4>
                        <ul>
                            <li><a href="#">Đời Sống <span>09</span></a></li>
                            <li><a href="#">Du Lịch <span>12</span></a></li>
                            <li><a href="#">Thời Trang <span>19</span></a>
                            </li>
                            <li><a href="#">Xây Dựng Thương Hiệu <span>17</span></a></li>
                            <li><a href="#">Âm Nhạc <span>10</span></a></li>
                        </ul>
                    </div>

                    <!-- Trending Posts -->
                    <div class="single_widgets widget_thumb_post">
                        <h4 class="title">Xu Hướng</h4>
                        <ul>
                            <li>
                                <span class="left">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Son_Tung_M-TP_1_%282017%29.png/1200px-Son_Tung_M-TP_1_%282017%29.png" alt="" class=""> {{-- https://via.placeholder.com/1200x800 --}}
                                </span>
                                <span class="right">
                                    <a class="feed-title" href="#">Sơn Tùng MTP ra mắt MV mới</a>
                                    <span class="post-date"><i class="ti-calendar"></i>10 phút trước</span>
                                </span>
                            </li>
                            <li>
                                <span class="left">
                                    <img src="https://vinuni.edu.vn/wp-content/uploads/2024/12/phan-biet-tang-truong-kinh-te-va-phat-trien-kinh-te-1.jpg" alt="" class="">
                                </span>
                                <span class="right">
                                    <a class="feed-title" href="#">Phân biệt tăng trưởng kinh tế và phát triển kinh tế</a>
                                    <span class="post-date"><i class="ti-calendar"></i>2 giờ trước</span>
                                </span>
                            </li>
                            <li>
                                <span class="left">
                                    <img src="https://media.vneconomy.vn/w800/images/upload/2021/05/19/asus-zenbook-duo-14.JPG" alt="" class="">
                                </span>
                                <span class="right">
                                    <a class="feed-title" href="#">Thiếu linh kiện, giá laptop, máy tính tăng ngược quy luật</a>
                                    <span class="post-date"><i class="ti-calendar"></i>4 tiếng trước</span>
                                </span>
                            </li>
                            <li>
                                <span class="left">
                                    <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2024/01/microsoft-ngung-ho-tro-windows-10-5.jpg" alt="" class="">
                                </span>
                                <span class="right">
                                    <a class="feed-title" href="#">Microsoft ngừng nâng cấp lên Windows 10 miễn phí</a>
                                    <span class="post-date"><i class="ti-calendar"></i>7 tiếng trước</span>
                                </span>
                            </li>
                            <li>
                                <span class="left">
                                    <img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/08/camera-cua-oppo-reno-10-5g-1.jpg" alt="" class="">
                                </span>
                                <span class="right">
                                    <a class="feed-title" href="#">Camera OPPO Reno10 5G - camera điểm 10</a>
                                    <span class="post-date"><i class="ti-calendar"></i>3 ngày trước</span>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Tags Cloud -->
                    <div class="single_widgets widget_tags">
                        <h4 class="title">Tags</h4>
                        <ul>
                            <li><a href="#">Doisong</a></li>
                            <li><a href="#">Dulich</a></li>
                            <li><a href="#">Thoitrang</a></li>
                            <li><a href="#">Xaydungthuonghieu</a></li>
                            <li><a href="#">Amnhac</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="space bg-cover" style="background:#03343b url(assets/img/landing-bg.png) no-repeat;">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center mb-5">
                        <h6 class="text-light mb-0">Đăng Ký Ngay (Subcribe Now)</h6>
                        <h2 class="ft-bold text-light">Nhận Tất Cả Thông Tin Về Việc Làm Mới Nhất</h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12 col-12">
                    <form class="bg-white rounded p-1">
                        <div class="row no-gutters">
                            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
                                <div class="form-group mb-0 position-relative">
                                    <input type="text" class="form-control lg left-ico"
                                        placeholder="Điền Email của bạn tại đây...">
                                    <i class="bnc-ico lni lni-envelope"></i>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                                <div class="form-group mb-0 position-relative">
                                    <button class="btn full-width custom-height-lg theme-bg text-light fs-md"
                                        type="button">Đăng Ký Nhận Thông Báo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
