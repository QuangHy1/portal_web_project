@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Người tìm việc')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employees/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Người tìm việc</h2>

        <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Người dùng</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="">Chọn người dùng</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $employee->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->email }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">Địa điểm</label>
                <select class="form-select" id="location_id" name="location_id">
                    <option value="">Chọn địa điểm</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $employee->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Họ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $employee->firstname) }}" required>
                @error('firstname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Tên</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $employee->lastname) }}" required>
                @error('lastname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Chức vụ</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $employee->designation) }}">
                @error('designation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Ảnh</label><br>
                @if ($employee->photo)
                    <img src="{{ asset($employee->photo) }}" alt="Ảnh hiện tại" class="avatar-img mb-2">
                @endif
                <input type="file" class="form-control" id="photo" name="photo">
                @error('photo')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $employee->website) }}">
                @error('website')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employee->address) }}">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <select class="form-select" id="gender" name="gender">
                    <option value="">Chọn giới tính</option>
                    <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
                @error('date_of_birth')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Tiểu sử</label>
                <textarea class="form-control" id="bio" name="bio">{{ old('bio', $employee->bio) }}</textarea>
                @error('bio')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $employee->facebook) }}">
                @error('facebook')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $employee->instagram) }}">
                @error('instagram')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="github" class="form-label">Github</label>
                <input type="text" class="form-control" id="github" name="github" value="{{ old('github', $employee->github) }}">
                @error('github')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
