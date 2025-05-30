@extends('admin.dashboard.layout')

@section('title', 'Hồ sơ của tôi')

@section('custom_css')
    @section('custom_css')
        <link rel="stylesheet" href="{{ asset('admin/css/admins/index.css') }}">
    @endsection
@endsection

@section('content')
    <form action="{{ route('admin.admins.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row col-lg-8 border rounded mx-auto mt-5 p-4 shadow-lg bg-white">
            {{-- Cột avatar bên trái --}}
            <div class="col-md-4 text-center">
                <img src="{{ asset('uploads/admins/' . $admin->avatar ) }}"
                     class="img-fluid rounded mb-3" style="width: 180px; height:180px; object-fit: cover;">

                <div class="mb-3">
                    <label for="avatar" class="form-label">Thay ảnh đại diện</label>
                    <input type="file" name="avatar" class="form-control" id="avatar">
                </div>
            </div>

            {{-- Cột thông tin bên phải --}}
            <div class="col-md-8">
                <h4 class="mb-4">Thông tin tài khoản</h4>
                <table class="table table-bordered">
                    <tr>
                        <th><i class="bi bi-envelope-at"></i> Email hệ thống</th>
                        <td>
                            <input value="{{ $admin->user->email ?? '' }}" type="email" name="email" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-person-circle"></i> Họ</th>
                        <td>
                            <input value="{{ $admin->firstname }}" type="text" name="firstname" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-person-square"></i> Tên</th>
                        <td>
                            <input value="{{ $admin->lastname }}" type="text" name="lastname" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-gender-ambiguous"></i> Giới tính</th>
                        <td>
                            <select name="gender" class="form-select">
                                <option value="">--Chọn giới tính--</option>
                                <option value="male" {{ $admin->gender == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ $admin->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ $admin->gender == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="bi bi-telephone"></i> Ngày sinh</th>
                        <td>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $admin->date_of_birth) }}">
                        </td>
                    </tr>

                    <tr>
                        <th><i class="bi bi-telephone"></i> Số điện thoại</th>
                        <td>
                            <input value="{{ $admin->phone }}" type="text" name="phone" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-envelope"></i> Email cá nhân</th>
                        <td>
                            <input value="{{ $admin->personal_email }}" type="email" name="personal_email" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-geo-alt"></i> Địa chỉ</th>
                        <td>
                            <input value="{{ $admin->address }}" type="text" name="address" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-geo-alt"></i> Địa điểm</th>
                        <td>
                            <select name="location_id" class="form-select">
                                <option value="">--Chọn Location--</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ $admin->location_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-key"></i> Mật khẩu mới</th>
                        <td>
                            <input type="password" name="password" class="form-control" placeholder="Để trống nếu không đổi">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-key-fill"></i> Nhập lại mật khẩu</th>
                        <td>
                            <input type="password" name="password_confirmation" class="form-control">
                        </td>
                    </tr>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarImage = document.querySelector('.col-md-4 img');

            avatarInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        avatarImage.src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
