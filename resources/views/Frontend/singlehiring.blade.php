@php \Carbon\Carbon::setLocale('vi'); @endphp
@extends('Frontend.layouts.master')
@section('page_title'){{ $jobPost->title }} @endsection
@section('body_content')
<div class="bg-light rounded py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="jbd-01 d-flex align-items-center justify-content-between">
                    <div class="jbd-flex d-flex align-items-center justify-content-start">
                        <div class="jbd-01-thumb">
                            <img src="{{ asset('uploads/companies').'/'. $jobPost->company->logo }}" class="img-fluid" width="100" alt="" />
                        </div>
                        <div class="jbd-01-caption pl-3">
                            <div class="tbd-title"><h4 class="mb-0 ft-medium fs-md">{{ $jobPost->title }}<img src="assets/img/verify.svg" class="ml-1" width="12" alt=""></h4></div>
                            <div class="jbl_location mb-3">
                                <span><i class="lni lni-map-marker mr-1"></i>{{ $jobPost->location->name }}</span>
                                <span class="ml-3"><i class="lni lni-briefcase mr-1"></i>{{ $jobPost->company->name }}</span> {{-- {{ $jobPost->employer->firstname }} {{ $jobPost->employer->lastname }} --}}
                                <span class="ml-3"><i class="lni lni-money-protection mr-1"></i>{{ $jobPost->salaryRange->name }} PA</span>
                            </div>
                            <div class="jbl_info01">
                                <span class="px-2 py-1 ft-medium medium text-light theme-bg rounded mr-2">{{ $jobPost->jobType->name }}</span>
                                @if($jobPost->isBoosted == 'no') @else<span class="px-2 py-1 ft-medium medium text-light bg-purple rounded mr-2">Đã boost</span>@endif
                                @if($jobPost->isfeatured == 'no') @else<span class="px-2 py-1 ft-medium medium text-light bg-info rounded">Nổi bật</span>@endif
                            </div>
                        </div>
                    </div>
                    @if(!Auth::guard('employer')->check())
                    <div class="jbd-01-right text-right">
                        <div class="jbl_button mb-2">@auth('employee')
                                <a href="{{ route('employee.apply', $jobPost->id) }}" class="btn btn-md rounded theme-bg-light theme-cl fs-sm ft-medium">Apply</a>
                            @else
                                <a href="{{ route('employee.signin') }}" class="btn btn-md rounded theme-bg-light theme-cl fs-sm ft-medium"
                                   onclick="return confirm('Bạn cần đăng nhập bằng tài khoản ứng viên để ứng tuyển. Bạn có muốn đăng nhập không?')">
                                    Apply
                                </a>
                            @endauth</div>
                        <div class="jbl_button">
                            <a href="{{ route('employer.details', $jobPost->employer->id) }}" class="btn btn-md rounded bg-white border fs-sm ft-medium">Xem Công ty</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Searchbar Banner ======================== -->

<!-- ============================ Job Details Start ================================== -->
<section class="py-5">
    <div class="container">
        <div class="row">

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <div class="rounded mb-4">
                    <div class="jbd-01 pr-3">
                        <div class="jbd-details mb-4">
                            <h5 class="ft-medium fs-md">Mô tả Công Việc</h5>
                            <p>{{ $jobPost->description }}</p>
                        </div>

{{--                        <div class="jbd-details mb-3">--}}
{{--                            <h5>Yêu cầu:</h5>--}}
{{--                            <div class="position-relative row">--}}
{{--                                <div class="col-lg-12 col-md-12 col-12">--}}
{{--                                    @foreach($jobPost->requirement as $requirements)--}}
{{--                                    <div class="mb-2 mr-4 ml-lg-0 mr-lg-4">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                          <div class="rounded-circle bg-light-success theme-cl p-1 small d-flex align-items-center justify-content-center">--}}
{{--                                            <i class="fas fa-check small"></i>--}}
{{--                                          </div>--}}
{{--                                          <h6 class="mb-0 ml-3 text-muted fs-sm">{{ $requirements->requirements }}</h6>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="jbd-details mb-4">
                            <h5 class="ft-medium fs-md">Thông Tin Thêm</h5>
                            <div class="other-details">
                                <div class="details ft-medium"><label class="text-muted">Vị Trí Công Việc:</label><span class="text-dark">{{ $jobPost->title }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Lĩnh Vực:</label><span class="text-dark">{{ $jobPost->jobCategory->name }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Kinh Nghiệm:</label><span class="text-dark">{{ $jobPost->experience->name }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Hình Thức Làm Việc:</label><span class="text-dark">{{ $jobPost->jobType->name }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Trình độ/Học vấn:</label><span class="text-dark">{{ $jobPost->education }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Slot: </label><span class="text-dark">Còn {{ $jobPost->vacancy->name }}</span></div>
                                <div class="details ft-medium"><label class="text-muted">Thời Hạn Apply:</label><span class="text-dark">{{ date('d - m - Y', strtotime($jobPost->deadline)) }}</span></div>
                            </div>
                        </div>

                        <div class="jbd-details mb-1">
                            <h5 class="ft-medium fs-md">Từ Khóa</h5>
                            @php
                            $tags = $jobPost->tags;
                            $tag_array = explode(',', $tags);
                            @endphp
                            <ul class="p-0 skills_tag text-left">
                                @foreach($tag_array as $tag)
                                <li><span class="px-2 py-1 medium skill-bg rounded text-dark">{{ $tag }}</span></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="jbd-02 pt-4 pr-3">
                        <div class="jbd-02-flex d-flex align-items-center justify-content-between">
                            @if(Auth::guard('employer')->check())
                                {{-- Không hiển thị nút Apply hay Bookmark nếu là nhà tuyển dụng --}}
                            @elseif(Auth::guard('employee')->check())
                                {{-- Nếu là ứng viên đã đăng nhập --}}
                                <div class="jbl_button mb-2">
                                    <a href="{{ route('employee.job.bookmark', $jobPost->id) }}" class="btn btn-md rounded gray fs-sm ft-medium mr-2">Lưu lại</a>
                                    <a href="{{ route('employee.apply', $jobPost->id) }}" class="btn btn-md rounded theme-bg text-light fs-sm ft-medium">Apply</a>
                                </div>
                            @else
                                {{-- Nếu là khách (chưa đăng nhập) --}}
                                <div class="jbl_button mb-2">
                                    <a href="{{ route('employee.signin') }}" class="btn btn-md rounded gray fs-sm ft-medium mr-2"
                                       onclick="return confirm('Bạn cần đăng nhập bằng tài khoản ứng viên để lưu công việc. Bạn có muốn đăng nhập không?')">
                                        Lưu lại
                                    </a>
                                    <a href="{{ route('employee.signin') }}" class="btn btn-md rounded theme-bg text-light fs-sm ft-medium"
                                       onclick="return confirm('Bạn cần đăng nhập bằng tài khoản ứng viên để ứng tuyển. Bạn có muốn đăng nhập không?')">
                                        Apply
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->

            {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="jb-apply-form bg-white shadow rounded py-3 px-4 box-static">
                    <h4 class="ft-medium fs-md mb-3">Intrested in this job?</h4>

                    <form class="_apply_form_form">

                        <div class="form-group">
                            <label class="text-dark mb-1 ft-medium medium">First Name</label>
                            <input @if(Auth::guard('employer')->check()) disabled @endif type="text" class="form-control" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <label class="text-dark mb-1 ft-medium medium">Your Email</label>
                            <input @if(Auth::guard('employer')->check()) disabled @endif type="email" class="form-control" placeholder="themezhub@gmail.com">
                        </div>

                        <div class="form-group">
                            <label class="text-dark mb-1 ft-medium medium">Phone Number:</label>
                            <input @if(Auth::guard('employer')->check()) disabled @endif type="text" class="form-control" placeholder="+91 245 256 2548">
                        </div>

                        <div class="form-group">
                            <label class="text-dark mb-1 ft-medium medium">Upload Resume:<small class="medium ft-medium">pdf, doc, docx</small></label>
                            <div class="custom-file">
                              <input @if(Auth::guard('employer')->check()) disabled @endif type="file" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="terms_con">
                                <input @if(Auth::guard('employer')->check()) disabled @endif id="aa3" class="checkbox-custom" name="Coffee" type="checkbox">
                                <label for="aa3" class="checkbox-custom-label">I agree to pirvacy policy</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-md rounded theme-bg text-light ft-medium fs-sm full-width" @if(Auth::guard('employer')->check()) disabled @endif>Apply Via Email</button>
                        </div>

                    </form>
                </div>
            </div> --}}

        </div>
    </div>
</section>
<!-- ============================ Job Details End ================================== -->

<!-- ======================= Related Jobs ======================== -->
<section class="space min gray">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center mb-5">
                    <h6 class="text-muted mb-0">Công Việc Liên Quan</h6>
                    <h2 class="ft-bold">Danh Sách Các Công Việc Liên Quan</h2>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row align-items-center">
            @foreach($relatedJobs as $relatedJob)
                <!-- Job Card -->
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <a href="{{ route('jobs', $relatedJob->id) }}" class="job_card d-block border1 rounded1 p-3 text-center text-dark text-decoration-none position-relative transition-all">
                        <div class="position-absolute ab-left">
                            <button type="button" class="p-3 border circle d-flex align-items-center justify-content-center bg-white text-gray">
                                <i class="lni lni-heart-filled position-absolute snackbar-wishlist"></i>
                            </button>
                        </div>
                        <div class="position-absolute ab-right radius1">
                            <span class="medium theme-cl2 theme-bg-light px-2 py-1 rounded">{{ $relatedJob->jobType->name }}</span>
                        </div>
                        <div class="job_card_thumb mb-3 pt-5">
                            <img src="{{ asset('uploads/companies/' . $relatedJob->company->logo) }}" class="img-fluid4" width="70" alt="Logo" />
                        </div>
                        <div class="job_card_caption mb-3">
                            <h6 class="mb-1 lh-1 ft-medium medium text-muted">{{ $relatedJob->company->name }}</h6>
                            <h4 class="mb-1 ft-medium medium fs-md text-dark">{{ $relatedJob->title }}</h4>
                            <div class="jbl_location"><i class="lni lni-map-marker mr-1"></i>{{ $relatedJob->location->name }}</div>
                        </div>
                        <div class="job_card_footer d-flex flex-column align-items-center gap-1">
                            <div class="text-muted1"><i class="lni lni-wallet mr-1"></i>{{ $relatedJob->salaryRange->name }}</div>
                            <div class="text-muted1"><i class="lni lni-timer mr-1"></i>{{ $relatedJob->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- row -->

    </div>
</section>
<!-- ======================= Related Jobs ======================== -->

<!-- ======================= Newsletter Start ============================ -->
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
                                <input type="text" class="form-control lg left-ico" placeholder="Điền Email của bạn tại đây...">
                                <i class="bnc-ico lni lni-envelope"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
                            <div class="form-group mb-0 position-relative">
                                <button class="btn full-width custom-height-lg theme-bg text-light fs-md" type="button">Click</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
