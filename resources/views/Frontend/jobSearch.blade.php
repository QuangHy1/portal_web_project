@extends('Frontend.layouts.master')
@section('page_title')Search Jobs @endsection
@section('body_content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="py-5 theme-bg" data-overlay="0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="banner_caption text-center mb-2">
                    <h1 class="ft-bold mb-4">Nhứng Công Việc Tuyệt Vời Nhất</h1>
                </div>

                <form class="bg-white rounded p-1" method="GET" action="{{ url('jobs') }}">
                    <div class="row no-gutters">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="form-group mb-0 position-relative">
                                <input type="text" class="form-control lg left-ico" name="jobs" placeholder="Tiêu đề, từ khóa,..." />
                                <i class="bnc-ico lni lni-search-alt"></i>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="form-group mb-0 position-relative">
                             <select name="location" class="custom-select lg b-0 left-ico">
                                <option value="">Vị Trí</option>
                                @foreach ($locations as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                              </select>
                                <i class="bnc-ico lni lni-target"></i>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group mb-0 position-relative">
                                <button class="btn full-width custom-height-lg bg-dark text-white fs-md" type="submit">Tìm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Searchbar Banner ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-2 br-bottom br-top">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                <h6 class="mb-0 ft-medium fs-sm">{{ $hirings->count() }} Tin Tuyển Dụng được tìm thấy !!</h6>
            </div>

            {{-- <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                <div class="filter_wraps elspo_wrap d-flex align-items-center justify-content-end">
                    <div class="single_fitres mr-2 br-right">
                        <select class="custom-select simple">
                          <option value="1" selected="">Default Sorting</option>
                          <option value="2">Recent jobs</option>
                          <option value="3">Featured jobs</option>
                          <option value="4">Trending Jobs</option>
                          <option value="5">Premium jobs</option>
                        </select>
                    </div>
                    <div class="single_fitres">
                        <a href="job-search-v1.html" class="simple-button mr-1"><i class="ti-layout-grid2"></i></a>
                        <a href="job-list-v1.html" class="simple-button active theme-cl"><i class="ti-view-list"></i></a>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
</section>
<!-- ============================= Filter Wrap ============================== -->

<!-- ============================ Main Section Start ================================== -->
<section class="bg-light" style="padding: 50px 0 80px !important;">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="bg-white rounded mb-4">

                    <div class="sidebar_header d-flex align-items-center justify-content-between px-4 py-3 br-bottom">
                        <h4 class="ft-medium fs-lg mb-0">Bộ Lọc</h4>
                        <div class="ssh-header">
                            <a href="javascript:void(0);" id="clear-filters" class="ft-medium text-danger">Xóa tất cả</a>
                            <a href="#search_open" data-toggle="collapse" aria-expanded="false" role="button" class="collapsed _filter-ico ml-2">
                                <i class="lni lni-text-align-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Find New Property -->
                    <div class="sidebar-widgets collapse miz_show" id="search_open" data-parent="#search_open">
                        <div class="search-inner">
                            <form method="GET" action="{{ url('jobs') }}" class="filter-form">

                                <div class="filter-search-box px-4 pt-3 pb-0">
                                    <div class="form-group">
                                        <input type="text" name="jobs" class="form-control" placeholder="Theo từ khóa..." value="{{ $hiringQuery }}">
                                    </div>
                                    <select name="location" class="custom-select mb-3">
                                        <option value="">Vị Trí</option>
                                        @foreach($locations as $item)
                                            <option @if($hiringLocation == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="filter_wraps">

                                    {{-- Job categories --}}
                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                        <div class="widget-boxed-header">
                                            <h4>
                                                <a href="#category" data-toggle="collapse" aria-expanded="false" role="button" class="ft-medium fs-md pb-0  @if($hiringJobCategory == null) collapsed @endif" @if($hiringJobCategory != null) expanded="true" @endif>Ngành Nghề</a>
                                            </h4>
                                        </div>
                                        <div class="widget-boxed-body collapse @if($hiringJobCategory != null) show @endif" id="category" data-parent="#category">
                                            <div class="side-list no-border">
                                                <div class="single_filter_card">
                                                    <div class="card-body p-0">
                                                        <div class="inner_widget_link">
                                                            <ul class="no-ul-list filter-list">
                                                                <li>
                                                                    <input id="e0" class="radio-custom" value="" name="category" type="radio" {{ is_null($hiringJobCategory) ? 'checked' : '' }}>
                                                                    <label for="e0" class="radio-custom-label">Tất cả</label>
                                                                </li>
                                                                @php $count = 1; @endphp
                                                                @foreach($categories as $item)
                                                                    <li>
                                                                        <input id="e{{ $count }}" class="radio-custom" value="{{ $item->id }}" name="category" type="radio" {{ $hiringJobCategory == $item->id ? 'checked' : '' }}>
                                                                        <label for="e{{ $count }}" class="radio-custom-label">{{ $item->name }}</label>
                                                                    </li>
                                                                    @php $count++; @endphp
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Job types --}}
                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                        <div class="widget-boxed-header">
                                            <h4>
                                                <a href="#jobtype" data-toggle="collapse" aria-expanded="false" role="button" class="ft-medium fs-md pb-0 collapsed @if($hiringJobType == null) collapsed @endif" @if($hiringJobType != null) expanded="true" @endif>Hình Thức Làm Việc</a>
                                            </h4>
                                        </div>
                                        <div class="widget-boxed-body collapse @if($hiringJobType != null) show @endif" id="jobtype" data-parent="#jobtype">
                                            <div class="side-list no-border">
                                                <div class="single_filter_card">
                                                    <div class="card-body p-0">
                                                        <div class="inner_widget_link">
                                                            <ul class="no-ul-list filter-list">
                                                                <li>
                                                                    <input id="ea0" class="radio-custom" value="" name="jobtype" type="radio" {{ is_null($hiringJobType) ? 'checked' : '' }}>
                                                                    <label for="ea0" class="radio-custom-label">Tất cả</label>
                                                                </li>
                                                                @php $count = 1; @endphp
                                                                @foreach($jobtype as $item)
                                                                    <li>
                                                                        <input id="ea{{ $count }}" class="radio-custom" value="{{ $item->id }}" name="jobtype" type="radio" @if($hiringJobType == $item->id) checked @endif>
                                                                        <label for="ea{{ $count }}" class="radio-custom-label">{{ $item->name }}</label>
                                                                    </li>
                                                                    @php $count++; @endphp
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Salary range --}}
                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                        <div class="widget-boxed-header">
                                            <h4>
                                                <a href="#salary" data-toggle="collapse" aria-expanded="false" role="button" class="ft-medium fs-md pb-0 collapsed @if($hiringSalaryRange == null) collapsed @endif" @if($hiringSalaryRange != null) expanded="true" @endif>Mức Lương</a>
                                            </h4>
                                        </div>
                                        <div class="widget-boxed-body collapse @if($hiringSalaryRange != null) show @endif" id="salary" data-parent="#salary">
                                            <div class="side-list no-border">
                                                <div class="single_filter_card">
                                                    <div class="card-body p-0">
                                                        <div class="inner_widget_link">
                                                            <ul class="no-ul-list filter-list">
                                                                <li>
                                                                    <input id="eb0" class="radio-custom" value="" name="salaryrange" type="radio" {{ is_null($hiringSalaryRange) ? 'checked' : '' }}>
                                                                    <label for="eb0" class="radio-custom-label">Tất cả</label>
                                                                </li>
                                                                @php $count = 1; @endphp
                                                                @foreach($salaryrange as $item)
                                                                    <li>
                                                                        <input id="eb{{ $count }}" class="radio-custom" value="{{ $item->id }}" name="salaryrange" type="radio" @if($hiringSalaryRange == $item->id) checked @endif>
                                                                        <label for="eb{{ $count }}" class="radio-custom-label">{{ $item->name }}</label>
                                                                    </li>
                                                                    @php $count++; @endphp
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Experience --}}
                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                        <div class="widget-boxed-header">
                                            <h4>
                                                <a href="#experience" data-toggle="collapse" aria-expanded="false" role="button" class="ft-medium fs-md pb-0 collapsed @if($hiringExperience == null) collapsed @endif" @if($hiringExperience != null) expanded="true" @endif>Kinh Nghiệm</a>
                                            </h4>
                                        </div>
                                        <div class="widget-boxed-body collapse @if($hiringExperience != null) show @endif" id="experience" data-parent="#experience">
                                            <div class="side-list no-border">
                                                <div class="single_filter_card">
                                                    <div class="card-body p-0">
                                                        <div class="inner_widget_link">
                                                            <ul class="no-ul-list filter-list">
                                                                <li>
                                                                    <input id="ec0" class="radio-custom" value="" name="experience" type="radio" {{ is_null($hiringExperience) ? 'checked' : '' }}>
                                                                    <label for="ec0" class="radio-custom-label">Tất cả</label>
                                                                </li>
                                                                @php $count = 1; @endphp
                                                                @foreach($experience as $item)
                                                                    <li>
                                                                        <input id="ec{{ $count }}" class="radio-custom" value="{{ $item->id }}" name="experience" type="radio" @if($hiringExperience == $item->id) checked @endif>
                                                                        <label for="ec{{ $count }}" class="radio-custom-label">{{ $item->name }}</label>
                                                                    </li>
                                                                    @php $count++; @endphp
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group filter_button pt-2 pb-4 px-4">
                                    <button type="submit" class="btn btn-md theme-bg text-light rounded full-width">Lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item Wrap Start -->
            <div class="col-lg-8 col-md-12 col-sm-12">

                <!-- row -->
                <div class="row align-items-center">
                    @if(!$hirings->count())
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-center border rounded">
                                <div class="rounded bg-white px-3 py-3">
                                    <div class=" rounded bg-white text-center">
                                      <img src="{{ asset('frontEndAssets/img/nosearch.svg') }}" class="mx-auto d-block" width="350" alt="No Result Found"><h1>Rất tiếc !! Không tìm thấy Công Việc bạn cần.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else

                    @foreach($hirings as $hiring)

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="jbr-wrap text-left border rounded">
                            <div class="cats-box mlb-res rounded bg-white d-flex align-items-center justify-content-between px-3 py-3">
                                <div class="cats-box rounded bg-white d-flex align-items-center">
                                    <div class="text-center"><img src="{{ asset('uploads/companies').'/'. $hiring->company->logo }}" class="img-fluid" width="55" alt=""></div>
                                    <div class="cats-box-caption px-2">
                                        <h4 class="fs-md mb-0 ft-medium">{{ $hiring->title }}</h4>
                                        <div class="d-block mb-2 position-relative">
                                            <span class="text-muted medium"><i class="lni lni-map-marker mr-1"></i>{{ $hiring->location->name }}</span>
                                            <span class="muted medium ml-2 theme-cl"><i class="lni lni-briefcase mr-1"></i>{{ $hiring->jobType->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mlb-last"><a href="{{ route('jobs', $hiring->id) }}" class="btn gray ft-medium apply-btn fs-sm rounded">Xem Chi Tiết<i class="lni lni-arrow-right-circle ml-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
{{--                    {{ $hirings->appends($_GET)->links() }}--}}
                </div>
                @if ($hirings->lastPage() > 1)
                    <div class="col-12 mt-4">
                        <div class="rounded border p-2 d-flex justify-content-center" style="border: 3px solid #a5dc86 !important; ">
                            <ul class="pagination mb-0" style="margin:0 !important">

                                {{-- Nút Previous --}}
                                <li class="page-item prev-btn {{ $hirings->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $hirings->previousPageUrl() ?? '#' }}" tabindex="-1">&laquo;</a>
                                </li>

                                {{-- Trang đầu tiên --}}
                                <li class="page-item {{ $hirings->currentPage() == 1 ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $hirings->url(1) }}">1</a>
                                </li>

                                {{-- Trang thứ hai nếu tổng > 2 --}}
                                @if ($hirings->lastPage() > 2 && $hirings->currentPage() > 2)
                                    {{-- Dấu ba chấm nếu cách xa --}}
                                    @if ($hirings->currentPage() > 3)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif

                                    {{-- Trang hiện tại -1 nếu cần --}}
                                    @if ($hirings->currentPage() < $hirings->lastPage())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $hirings->url($hirings->currentPage() - 1) }}">{{ $hirings->currentPage() - 1 }}</a>
                                        </li>
                                    @endif

                                    {{-- Trang hiện tại --}}
                                    @if ($hirings->currentPage() != 1 && $hirings->currentPage() != $hirings->lastPage())
                                        <li class="page-item active">
                                            <a class="page-link" href="#">{{ $hirings->currentPage() }}</a>
                                        </li>
                                    @endif

                                    {{-- Trang hiện tại +1 nếu cần --}}
                                    @if ($hirings->currentPage() < $hirings->lastPage() - 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $hirings->url($hirings->currentPage() + 1) }}">{{ $hirings->currentPage() + 1 }}</a>
                                        </li>
                                    @endif

                                    {{-- Dấu ba chấm nếu không liền kề trang cuối --}}
                                    @if ($hirings->currentPage() < $hirings->lastPage() - 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endif

                                {{-- Trang cuối nếu khác trang đầu --}}
                                @if ($hirings->lastPage() > 1 && $hirings->currentPage() != $hirings->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $hirings->url($hirings->lastPage()) }}">{{ $hirings->lastPage() }}</a>
                                    </li>
                                @endif

                                {{-- Nút Next --}}
                                <li class="page-item next-btn {{ !$hirings->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $hirings->nextPageUrl() ?? '#' }}">&raquo;</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                @endif
                <!-- row -->

{{--                --}}{{-- <div class="row">--}}
{{--                    <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                        <ul class="pagination">--}}
{{--                            <li class="page-item">--}}
{{--                              <a class="page-link" href="#" aria-label="Previous">--}}
{{--                                <span class="fas fa-arrow-circle-right"></span>--}}
{{--                                <span class="sr-only">Previous</span>--}}
{{--                              </a>--}}
{{--                            </li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item active"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">...</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">18</a></li>--}}
{{--                            <li class="page-item">--}}
{{--                              <a class="page-link" href="#" aria-label="Next">--}}
{{--                                <span class="fas fa-arrow-circle-right"></span>--}}
{{--                                <span class="sr-only">Next</span>--}}
{{--                              </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div> --}}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('clear-filters').addEventListener('click', function () {
            const form = document.querySelector('.filter-form');

            // Reset text input
            form.querySelector('input[name="jobs"]').value = '';

            // Reset select dropdown
            form.querySelector('select[name="location"]').selectedIndex = 0;

            // Reset all radio groups
            const radioNames = ['category', 'jobtype', 'salaryrange', 'experience'];
            radioNames.forEach(name => {
                const radios = form.querySelectorAll(`input[name="${name}"]`);
                radios.forEach(radio => {
                    if (radio.value === "") {
                        radio.checked = true;
                    } else {
                        radio.checked = false;
                    }
                });
            });

            // // Optional: submit form to apply cleared filters immediately
            // form.submit();
        });
    </script>
</section>
<!-- ============================ Main Section End ================================== -->

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
                                <button class="btn full-width custom-height-lg theme-bg text-light fs-md" type="button"> Click </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
