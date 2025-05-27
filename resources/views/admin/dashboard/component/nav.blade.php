<!--Thanh navbar ngang-->
<nav class="navbar navbar-expand px-4 py-3">
    <div class="navbar-brand">
        <a href="{{ route('admin.dashboard') }}" class="d-inline-block align-middle">
            <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo Công Ty" class="img-fluid" style="max-height: 50px;">
        </a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <!-- Icon dropdown thông báo tài khoản mới cần duyệt -->
            <li class="nav-item dropdown position-relative">
                <a href="#" class="nav-link bellring" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bxs-bell-ring fs-4'></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $pendingAccountCount }}
        </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 shadow-sm" aria-labelledby="accountDropdown" style="min-width: 250px;">
                    @if ($pendingAccountCount > 0)
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center text-primary fw-bold"
                               href="{{ route('admin.account.approve.list') }}">
                                {{ $pendingAccountCount }} tài khoản đang chờ duyệt
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="dropdown-item text-muted">
                            Không có tài khoản nào đang chờ duyệt.
                        </li>
                    @endif
                </ul>
            </li>
            <!-- Icon dropdown thông báo giao dịch boost -->
            <li class="nav-item dropdown position-relative">
                <a href="#" class="nav-link money fs-4" id="boostDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-money-withdraw'></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $pendingBoostCount }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 shadow-sm" aria-labelledby="boostDropdown" style="min-width: 250px;">
                    @if ($pendingBoostCount > 0)
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center text-primary fw-bold"
                               href="{{ route('admin.boost_order.approve.list') }}">
                                {{ $pendingBoostCount }} giao dịch boost cần duyệt
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="dropdown-item text-muted">
                            Không có giao dịch boost nào đang chờ duyệt.
                        </li>
                    @endif
                </ul>
            </li>
            <!-- Avatar -->
            <li class="nav-item dropdown">
{{--                <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">--}}
{{--                    <img src="{{ asset('login/img/user_ava.jpg') }}" class="avatar img-fluid rounded-circle" alt="Default Avatar">--}}
{{--                </a>--}}
                <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                    @if ($loggedInAdmin && $loggedInAdmin->avatar)
                        <img src="{{ asset('uploads/admins/' . $loggedInAdmin->avatar) }}" class="avatar img-fluid rounded-circle" alt="Admin Avatar" style="width: 50px; height: 50px;border: 3px solid #fbffff; box-shadow: 0 0 15px #00fbff;">
                    @else
                        <img src="{{ asset('login/img/user_ava.jpg') }}" class="avatar img-fluid rounded-circle" alt="Default Avatar">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <a href="{{ route('admin.admins.index') }}" class="dropdown-item">
                        <span>Hồ sơ</span>
                        <i class='bx bx-user'></i>
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" id="logout-form-nav">
                        @csrf
                        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                            <span>Đăng xuất</span>
                            <i class='bx bx-log-in-circle'></i>
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
