<ul class="nav-menu">
    <li><a href="{{ route('home') }}">Home</a></li>
{{--    <li><a href="javascript:void(0);">Find Job</a></li> --}}{{-- TODO: Mở lại khi route 'job.search' hoàn tất --}}
    <li><a href="{{ route('job.search') }}">Công Việc</a></li>

    {{-- <li><a href="javascript:void(0);">Candidates</a></li> --}}
{{--    <li><a href="javascript:void(0);">Employers</a></li> --}}{{-- TODO: Mở lại khi route 'employer.browse' hoàn tất --}}
        <li><a href="{{ route('employer.browse') }}">Nhà Tuyển Dụng</a></li>

    {{-- <li><a href="javascript:void(0);">Pages</a></li></ul> --}}

</ul>
