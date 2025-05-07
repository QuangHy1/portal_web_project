@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Vị trí Tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/hirings/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Vị trí Tuyển dụng</h2>

        <form action="{{ route('admin.hirings.update', $hiring->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $hiring->title) }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $hiring->description) }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">Địa điểm</label>
                <select class="form-select" id="location_id" name="location_id" required>
                    <option value="">Chọn địa điểm</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $hiring->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="employer_id" class="form-label">Nhà tuyển dụng</label>
                <select class="form-select" id="employer_id" name="employer_id">
                    <option value="">Chọn nhà tuyển dụng</option>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}" {{ old('employer_id', $hiring->employer_id) == $employer->id ? 'selected' : '' }}>
                            {{ $employer->firstname }} {{ $employer->lastname }}
                        </option>
                    @endforeach
                </select>
                @error('employer_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary_range_id" class="form-label">Mức lương</label>
                <select class="form-select" id="salary_range_id" name="salary_range_id">
                    <option value="">Chọn mức lương</option>
                    @foreach ($salaryRanges as $salaryRange)
                        <option value="{{ $salaryRange->id }}" {{ old('salary_range_id', $hiring->salary_range_id) == $salaryRange->id ? 'selected' : '' }}>
                            {{ $salaryRange->name }}
                        </option>
                    @endforeach
                </select>
                @error('salary_range_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="company_id" class="form-label">Công ty</label>
                <select class="form-select" id="company_id" name="company_id">
                    <option value="">Chọn công ty</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', $hiring->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="vacancy_id" class="form-label">Vị trí</label>
                <select class="form-select" id="vacancy_id" name="vacancy_id">
                    <option value="">Chọn vị trí</option>
                    @foreach ($vacancies as $vacancy)
                        <option value="{{ $vacancy->id }}" {{ old('vacancy_id', $hiring->vacancy_id) == $vacancy->id ? 'selected' : '' }}>
                            {{ $vacancy->name }}
                        </option>
                    @endforeach
                </select>
                @error('vacancy_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="job_category_id" name="job_category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach ($jobCategories as $jobCategory)
                        <option value="{{ $jobCategory->id }}" {{ old('job_category_id', $hiring->job_category_id) == $jobCategory->id ? 'selected' : '' }}>
                            {{ $jobCategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('job_category_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="job_type_id" class="form-label">Loại hình</label>
                <select class="form-select" id="job_type_id" name="job_type_id" required>
                    <option value="">Chọn loại hình</option>
                    @foreach ($jobTypes as $jobType)
                        <option value="{{ $jobType->id }}" {{ old('job_type_id', $hiring->job_type_id) == $jobType->id ? 'selected' : '' }}>
                            {{ $jobType->name }}
                        </option>
                    @endforeach
                </select>
                @error('job_type_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="experience_id" class="form-label">Kinh nghiệm</label>
                <select class="form-select" id="experience_id" name="experience_id" required>
                    <option value="">Chọn kinh nghiệm</option>
                    @foreach ($experiences as $experience)
                        <option value="{{ $experience->id }}" {{ old('experience_id', $hiring->experience_id) == $experience->id ? 'selected' : '' }}>
                            {{ $experience->name }}
                        </option>
                    @endforeach
                </select>
                @error('experience_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $hiring->tags) }}">
                @error('tags')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" class="form-control" id="deadline" name="deadline"
                       value="{{ old('deadline', $hiring->deadline) }}" required>
                @error('deadline')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="education" class="form-label">Học vấn</label>
                <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $hiring->education) }}" required>
                @error('education')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Yêu cầu giới tính</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Chọn </option>
                    <option value="Nam" {{ old('gender', $hiring->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ old('gender', $hiring->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    <option value="Không yêu cầu (All gender)" {{ old('gender', $hiring->gender) == 'Không yêu cầu (All gender)' ? 'selected' : '' }}>Không yêu cầu (All gender)</option>
                </select>
                @error('gender')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isfeatured" class="form-label">Nổi bật</label>
                <select class="form-select" id="isfeatured" name="isfeatured" required>
                    <option value="">Chọn</option>
                    <option value="yes" {{ old('isfeatured', $hiring->isfeatured) == 'yes' ? 'selected' : '' }}>Có</option>
                    <option value="no" {{ old('isfeatured', $hiring->isfeatured) == 'no' ? 'selected' : '' }}>Không</option>
                </select>
                @error('isfeatured')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isBoosted" class="form-label">Boost</label>
                <select class="form-select" id="isBoosted" name="isBoosted" required>
                    <option value="">Chọn</option>
                    <option value="yes" {{ old('isBoosted', $hiring->isBoosted) == 'yes' ? 'selected' : '' }}>Có</option>
                    <option value="no" {{ old('isBoosted', $hiring->isBoosted) == 'no' ? 'selected' : '' }}>Không</option>
                </select>
                @error('isBoosted')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Chọn trạng thái</option>
                    <option value="active" {{ old('status', $hiring->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status', $hiring->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="token" class="form-label">Mã Token</label>
                <input type="text" class="form-control" id="token" name="token" value="{{ old('token', $hiring->token) }}" >
                @error('token')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.hirings.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
