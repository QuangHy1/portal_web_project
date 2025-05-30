@extends('admin.dashboard.layout')

@section('title', 'Quản lý Tin tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/hirings/index.css') }}">
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Tin tuyển dụng</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.hirings.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm tin tuyển dụng..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.hirings.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach ($hirings as $hiring)
                <div class="col-md-6 col-lg-4">
                    <div class="hiring-card ">
                        <div class="hiring-title">
                            {{ \Illuminate\Support\Str::limit($hiring->title, 60, '...') }}
                        </div>

                        <div class="hiring-description">
                            {{ \Illuminate\Support\Str::limit(strip_tags($hiring->description), 100, '...') }}
                        </div>

                        <div class="hiring-info">
                            <strong>Địa điểm:</strong> {{ $hiring->location->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Nhà tuyển dụng:</strong> {{ $hiring->employer->firstname . ' ' . $hiring->employer->lastname ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Mức lương:</strong> {{ $hiring->salaryRange->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Công ty:</strong> {{ $hiring->company->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Vị trí:</strong> {{ $hiring->vacancy->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Danh mục:</strong> {{ $hiring->jobCategory->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Loại hình:</strong> {{ $hiring->jobType->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Kinh nghiệm:</strong> {{ $hiring->experience->name ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Tags:</strong> {{ $hiring->tags ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Deadline:</strong> {{ $hiring->deadline }}
                        </div>
                        <div class="hiring-info">
                            <strong>Học vấn:</strong> {{ $hiring->education ?? 'N/A' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Giới tính:</strong>
                            @if ($hiring->gender == 'Nam')
                                Nam
                            @elseif ($hiring->gender == 'Nữ')
                                Nữ
                            @else
                                Không yêu cầu (All gender)
                            @endif
                        </div>
                        <div class="hiring-info">
                            <strong>Nổi bật:</strong> {{ $hiring->isfeatured == 'yes' ? 'Có' : 'Không' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Boost:</strong> {{ $hiring->isBoosted == 'yes' ? 'Có' : 'Không' }}
                        </div>
                        <div class="hiring-info">
                            <strong>Trạng thái:</strong> {{ $hiring->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                        </div>

                        <div class="hiring-actions">
                            <a href="{{ route('admin.hirings.edit', $hiring->id) }}"
                               class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.hirings.destroy', $hiring->id) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $hirings->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
