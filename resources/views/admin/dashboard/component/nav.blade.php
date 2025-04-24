<!--Thanh navbar ngang-->
<nav class="navbar navbar-expand px-4 py-3">
    <div class="navbar-brand">
        <a href="{{ route('admin.dashboard') }}" class="d-inline-block align-middle">
            <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo Công Ty" class="img-fluid" style="max-height: 50px;">
        </a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <!-- Icon thông báo -->
            <li class="nav-item position-relative">
                <a href="#" class="nav-link">
                    <i class='bx bxs-bell-ring'></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3+
                    </span>
                </a>
            </li>
            <!-- Icon thư -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class='bx bx-envelope'></i>
                </a>
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
