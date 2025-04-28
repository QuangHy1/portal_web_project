@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Nhà tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employers/edit.css') }}">
@endsection


@section('content')
    <div class="container">
        <h2>Chỉnh sửa Nhà tuyển dụng</h2>

        <form action="{{ route('admin.employers.update', $employer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Người dùng</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="">Chọn người dùng</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $employer->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="company_id" class="form-label">Công ty</label>
                <select class="form-select" id="company_id" name="company_id" required>
                    <option value="">Chọn công ty</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', $employer->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">Địa điểm</label>
                <select class="form-select" id="location_id" name="location_id">
                    <option value="">Chọn địa điểm</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $employer->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="industry_id" class="form-label">Lĩnh vực</label>
                <select class="form-select" id="industry_id" name="industry_id">
                    <option value="">Chọn lĩnh vực</option>
                    @foreach ($industries as $industry)
                        <option value="{{ $industry->id }}" {{ old('industry_id', $employer->industry_id) == $industry->id ? 'selected' : '' }}>
                            {{ $industry->name }}
                        </option>
                    @endforeach
                </select>
                @error('industry_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Họ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $employer->firstname) }}" required>
                @error('firstname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Tên</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $employer->lastname) }}" required>
                @error('lastname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employer->phone) }}">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employer->address) }}">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <select class="form-select" id="gender" name="gender">
                    <option value="">Chọn giới tính</option>
                    <option value="male" {{ old('gender', $employer->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender', $employer->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ old('gender', $employer->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $employer->date_of_birth instanceof \DateTime ? $employer->date_of_birth->format('Y-m-d') : $employer->date_of_birth) }}">
                @error('date_of_birth')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="about" class="form-label">Giới thiệu</label>
                <textarea class="form-control" id="about" name="about">{{ old('about', $employer->about) }}</textarea>
                @error('about')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_monday" class="form-label">Giờ làm việc thứ 2</label>
                <input type="text" class="form-control" id="hours_monday" name="hours_monday" value="{{ old('hours_monday', $employer->hours_monday) }}">
                @error('hours_monday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_tuesday" class="form-label">Giờ làm việc thứ 3</label>
                <input type="text" class="form-control" id="hours_tuesday" name="hours_tuesday" value="{{ old('hours_tuesday', $employer->hours_tuesday) }}">
                @error('hours_tuesday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_wednesday" class="form-label">Giờ làm việc thứ 4</label>
                <input type="text" class="form-control" id="hours_wednesday" name="hours_wednesday" value="{{ old('hours_wednesday', $employer->hours_wednesday) }}">
                @error('hours_wednesday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_thursday" class="form-label">Giờ làm việc thứ 5</label>
                <input type="text" class="form-control" id="hours_thursday" name="hours_thursday" value="{{ old('hours_thursday', $employer->hours_thursday) }}">
                @error('hours_thursday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_friday" class="form-label">Giờ làm việc thứ 6</label>
                <input type="text" class="form-control" id="hours_friday" name="hours_friday" value="{{ old('hours_friday', $employer->hours_friday) }}">
                @error('hours_friday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_saturday" class="form-label">Giờ làm việc thứ 7</label>
                <input type="text" class="form-control" id="hours_saturday" name="hours_saturday" value="{{ old('hours_saturday', $employer->hours_saturday) }}">
                @error('hours_saturday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hours_sunday" class="form-label">Giờ làm việc Chủ nhật</label>
                <input type="text" class="form-control" id="hours_sunday" name="hours_sunday" value="{{ old('hours_sunday', $employer->hours_sunday) }}">
                @error('hours_sunday')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $employer->facebook) }}">
                @error('facebook')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $employer->instagram) }}">
                @error('instagram')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="github" class="form-label">Github</label>
                <input type="text" class="form-control" id="github" name="github" value="{{ old('github', $employer->github) }}">
                @error('github')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isverified" class="form-label">Đã xác thực</label>
                <select class="form-select" id="isverified" name="isverified" required>
                    <option value="">Chọn</option>
                    <option value="1" {{ old('isverified', $employer->isverified) == 1 ? 'selected' : '' }}>Có</option>
                    <option value="0" {{ old('isverified', $employer->isverified) == 0 ? 'selected' : '' }}>Không</option>
                </select>
                @error('isverified')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isSuspended" class="form-label">Trạng thái đình chỉ</label>
                <select class="form-select" id="isSuspended" name="isSuspended" required>
                    <option value="">Chọn trạng thái</option>
                    <option value="no" {{ old('isSuspended', $employer->isSuspended) == 'no' ? 'selected' : '' }}>Không</option>
                    <option value="yes" {{ old('isSuspended', $employer->isSuspended) == 'yes' ? 'selected' : '' }}>Có</option>
                </select>
                @error('isSuspended')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.employers.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
