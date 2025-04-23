<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <!--Navbar dọc phía ngoài cùng trái-->
    <aside id="sidebar">
        <div class="d-flex">
            <button id="toggle-btn" type="button">
                <i class='bx bx-grid-alt'></i>
            </button>
            <div class="sidebar-logo">
                <a href="#">Admin Panel</a>
            </div>
        </div>

        <ul class="sidebar-nav">
            <!--Trang dashboard để thống kê-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bx-home-alt'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Dropdown của Users gồm Accounts và Roles/Permission-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
                    <i class='bx bxs-user-account'></i>
                    <span>QL Người dùng</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Tài khoản
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Quyền
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Dropdown của Employers gồm Employers và Companies-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#employers" aria-expanded="false" aria-controls="employers">
                    <i class='bx bx-buildings'></i>
                    <span>QL Tuyển dụng</span>
                </a>
                <ul id="employers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Nhà tuyển dụng
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Công ty
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Dropdown của Jobseekers gồm Jobseekers và Resumes-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#jobseekers" aria-expanded="false" aria-controls="jobseekers">
                    <i class='bx bx-male-female'></i>
                    <span>QL Người tìm việc</span>
                </a>
                <ul id="jobseekers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Người tìm việc
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Hồ sơ ứng tuyển
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Dropdown của Jobs gồm Jobs và Categories-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#jobs" aria-expanded="false" aria-controls="jobs">
                    <i class='bx bx-briefcase-alt-2'></i>
                    <span>QL Việc làm</span>
                </a>
                <ul id="jobs" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Tin tuyển dụng
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Loại công việc
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Dropdown của Contents gồm Posts và Guides-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#contents" aria-expanded="false" aria-controls="contents">
                    <i class='bx bx-bookmark-plus'></i>
                    <span>QL Bài đăng</span>
                </a>
                <ul id="contents" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Tin tuyển dụng
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Loại công việc
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Dropdown của Settings gồm Settings và Reports-->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#settings" aria-expanded="false" aria-controls="settings">
                    <i class='bx bxs-cog'></i>
                    <span>Cài đặt</span>
                </a>
                <ul id="settings" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Cấu hình chung
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            Báo cáo hệ thống
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Footer của sidebar sẽ chứa logout-->
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <span>Đăng xuất</span>
                <i class='bx bx-log-in'></i>
            </a>
        </div>
    </aside>

    <div class="main">
        <!--Thanh navbar ngang-->
        <nav class="navbar navbar-expand px-4 py-3">
            <!--Tìm kiếm-->
            <form action="#" class="d-none d-sm-inline-block">
                <div class="input-group input-group-navbar">
                    <input type="text" id="search-box" class="form-control border-0 rounder-0" placeholder="Tìm kiếm...">
                    <button class="btn-search border-0 rounder-0">
                        Tìm
                    </button>
                </div>
            </form>
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                            <img src="{{ asset('admin/img/account.png') }}" class="avatar img-fluid" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end rounded">
                            <a href="#" class="dropdown-item">
                                <span>Hồ sơ</span>
                                <i class='bx bx-user'></i>
                            </a>
                            <a href="#" class="dropdown-item">
                                <span>Đăng xuất</span>
                                <i class='bx bx-log-in-circle' ></i>
                            </a>
                            <div class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <i class='bx bx-question-mark'></i>
                                    <span>Analytics</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content px-3 py-4">
            <div class="container-fluid">
                <!-- Mục thống kê đầu tiên-->
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 mb-3"> Thống kê</h3>
                    <!--Vùng chứa card thống kê-->
                    <div class="row">
                        <!--Card 1-->
                        <div class="col-12 col-md-4">
                            <div class="card border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Member Process
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                            <span class="badge text-success1 me-2">
                                                +9.0%
                                            </span>
                                        <span class="fw-bold">
                                                Since last month
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Card 2-->
                        <div class="col-12 col-md-4">
                            <div class="card border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Member Process 2
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                            <span class="badge text-success1 me-2">
                                                +9.0%
                                            </span>
                                        <span class="fw-bold">
                                                Since last month
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Card 3-->
                        <div class="col-12 col-md-4">
                            <div class="card border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Member Process 3
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                            <span class="badge text-success1 me-2">
                                                +9.0%
                                            </span>
                                        <span class="fw-bold">
                                                Since last month
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-bold fs-4 my-3">Avg. agent</h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                <tr class="highlight">
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Footer cho các thông tin chung-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-body-secondary">
                    <div class="col-6 text-start">
                        <a href="#" class="text-body-secondary">
                            ADMIN PANEL
                        </a>
                    </div>
                    <div class="col-6 text-end text-body-secondary d-none d-md-block">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-body-secondary">
                                    Liên hệ
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-body-secondary">
                                    Về chúng tôi
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-body-secondary">
                                    Điều khoản và Điều kiện
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('admin/js/script.js') }}"></script>
</body>
</html>
