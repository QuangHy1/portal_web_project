<!--Navbar dọc phía ngoài cùng trái-->
<aside id="sidebar" class="expanded">
    <div class="d-flex">
        <button id="toggle-btn" type="button">
            <i class='bx bx-grid-alt'></i>
        </button>
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}" >Admin Panel</a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <!--Trang dashboard để thống kê-->
        <li class="sidebar-item">
            <a href="{{ route('admin.dashboard') }} " class="sidebar-link nav-link" >
                <i class='bx bx-home-alt'></i>
                <span>Tổng Quan</span>
            </a>
        </li>
        <!-- Dropdown của Users, Roles và Admin-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
                <i class='bx bxs-user-account'></i>
                <span>Người Dùng</span>
            </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link nav-link"> {{--  {{ route('admin.users.index') }} --}}
                            Tài khoản
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.roles.index') }} --}}
                            Vai trò
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.admins.index') }} --}}
                          Quản trị viên
                        </a>
                    </li>
            </ul>
        </li>
        <!-- Dropdown của Employee-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#employees" aria-expanded="false" aria-controls="employers">
                <i class='bx bx-male-female' style='color:#ffffff'></i>
                <span>Người tìm việc</span>
            </a>
            <ul id="employees" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.employees.index') }} --}}
                        Ứng viên
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.resumes.index') }} --}}
                        Hồ sơ ứng viên (CVs)
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.employee_applications.index') }} --}}
                        Đơn ứng tuyển
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.employee_bookmarks.index') }} --}}
                        Tin đã lưu
                    </a>
                </li>
            </ul>
        </li>
        <!-- Dropdown của Employers-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#employers" aria-expanded="false" aria-controls="employers">
                <i class='bx bx-buildings'></i>
                <span>Tuyển Dụng</span>
            </a>
            <ul id="employers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.employers.index') }} --}}
                        Nhà tuyển dụng
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link">{{-- {{ route('admin.companies.index') }} --}}
                        Công ty
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.industries.index') }} --}}
                        Lĩnh vực nghề nghiệp
                    </a>
                </li>
            </ul>
        </li>
        <!-- Dropdown của Hirings-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#hirings" aria-expanded="false" aria-controls="jobs">
                <i class='bx bx-briefcase-alt-2'></i>
                <span>Vị Trí Tuyển Dụng</span>
            </a>
            <ul id="hirings" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.hirings.index') }} --}}
                        Tin tuyển dụng
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.job_categories.index') }} --}}
                        Các ngành nghề
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.job_types.index') }} --}}
                        Hình thức làm việc
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.experiences.index') }} --}}
                        Kinh nghiệm
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.salary_ranges.index') }} --}}
                        Mức lương
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.vacancies.index') }} --}}
                        Vị trí trống
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.locations.index') }} --}}
                        Địa điểm
                    </a>
                </li>
            </ul>
        </li>
        <!-- Dropdown của Nội dung-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#contents" aria-expanded="false" aria-controls="contents">
                <i class='bx bx-bookmark-plus'></i>
                <span>Nội Dung</span>
            </a>
            <ul id="contents" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"> {{-- {{ route('admin.editors.index') }} --}}
                        Người chỉnh sửa
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"> {{-- {{ route('admin.posts.index') }} --}}
                        Bài viết
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"> {{-- {{ route('admin.topbars.index') }} --}}
                        Top bar
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"> {{-- {{ route('admin.page_home_items.index') }} --}}
                        Page Home Item
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"> {{-- {{ route('admin.footers.index') }} --}}
                        Footer
                    </a>
                </li>
            </ul>
        </li>
        <!-- Dropdown của Khác-->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#Others" aria-expanded="false" aria-controls="jobs">
                <i class='bx bx-mail-send'></i>
                <span>Khác</span>
            </a>
            <ul id="Others" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link nav-link"> {{-- {{ route('admin.user_testimonials.index') }} --}}
                        Đánh giá người dùng
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-link nav-link">
                        <span>Thư phản hồi</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Footer của sidebar sẽ chứa logout -->
    <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <span>Đăng xuất</span>
                <i class='bx bx-log-in'></i>
            </a>
    </div>
</aside>
