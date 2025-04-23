<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @yield('custom_css') <!-- Cho phép thêm CSS riêng -->
    <!-- Import CSS, Font Awesome, Bootstrap,... -->
    @include('admin.dashboard.component.header')
</head>
<body>
<div class="wrapper">
    @include('admin.dashboard.component.sidebar') <!-- Sidebar -->

    <div class="main">
        @include('admin.dashboard.component.nav') <!-- Navbar -->

        <main class="content px-3 py-4">
            <div class="container-fluid">
                @yield('content') <!-- Nội dung động -->
            </div>
        </main>

        @include('admin.dashboard.component.footer') <!-- Footer -->
    </div>
</div>
@yield('custom_js') <!-- Cho phép thêm JS riêng -->
@include('admin.dashboard.component.script')
</body>
</html>
