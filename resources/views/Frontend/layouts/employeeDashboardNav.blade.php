<div class="dashboard-wrap bg-light">
    <a class="mobNavigation" data-toggle="collapse" href="#MobNav" role="button" aria-expanded="false" aria-controls="MobNav">
        <i class="fas fa-bars mr-2"></i>Điều Hướng Chính
    </a>
         <div class="collapse" id="MobNav">
            <div class="dashboard-nav">
                <div class="dashboard-inner">
                    <ul data-submenu-title="Điều Hướng Chính">
                        <li class="{{ request()->is('employee/dashboard') ? 'active' : '' }}"><a href="{{ route('employee.dashboard') }}"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                        {{-- <li><a href="dashboard-manage-resume.html"><i class="lni lni-files mr-2"></i>Manage Resumes</a></li> --}}

                        <li class="{{ request()->is('employee/resumes') ? 'active' : '' }}"><a href="{{ route('employee.resumes.create') }}"><i class="lni lni-add-files mr-2"></i>Hồ Sơ Ứng Tuyển (CVs)</a></li>
{{--                        <li class=""><a href="#"><i class="lni lni-add-files mr-2"></i>Hồ Sơ Ứng Tuyển (CVs)</a></li>--}}

                        {{--                        <li class=""><a href="{{ route('employee.job.applied') }}"><i class="lni lni-briefcase mr-2"></i>Applied jobs</a></li>--}}
                        <li class=""><a href="{{ route('employee.job.applied') }}"><i class="lni lni-briefcase mr-2"></i>Tin Đã Ứng Tuyển</a></li>
                        {{-- <li><a href=""><i class="ti-bell mr-2"></i>Alert Jobs<span class="count-tag bg-warning">4</span></a></li> --}}

                        <li class="{{ request()->is('employee/job/bookmarks') ? 'active' : '' }}"><a href="{{ route('employee.job.bookmarks') }}"><i class="lni lni-bookmark mr-2"></i>Tin Đã Lưu</a></li>
                        {{-- <li><a href="dashboard-packages.html"><i class="lni lni-mastercard mr-2"></i>Boost AD</a></li> --}}
                        {{-- <li><a href="dashboard-messages.html"><i class="lni lni-envelope mr-2"></i>Messages<span class="count-tag">4</span></a></li> --}}
                    </ul>
                    <ul data-submenu-title="Tài Khoản">
                        <li class="{{ request()->is('employee/profile') ? 'active' : '' }}"><a href="{{ route('employee.profile') }}"><i class="lni lni-user mr-2"></i>Hồ Sơ </a></li>
                        <li class="{{ request()->is('employee/password/change') ? 'active' : '' }}"><a href="{{ route('employee.password.change') }}"><i class="lni lni-lock-alt mr-2"></i>Đổi Mật Khẩu</a></li>
                        <li class="{{ request()->is('employee/delete') ? 'active' : '' }}"><a href="{{ route('employee.delete') }}"><i class="lni lni-trash-can mr-2"></i>Xóa Tài Khoản</a></li>
                        <li><a href="{{ route('employee.logout') }}"><i class="lni lni-power-switch mr-2"></i>Đăng Xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
