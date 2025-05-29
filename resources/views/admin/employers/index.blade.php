@extends('admin.dashboard.layout')

@section('title', 'Quản lý Nhà tuyển dụng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/employers/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Danh sách Nhà tuyển dụng</h2>

        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.employers.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm nhà tuyển dụng..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.employers.create') }}" class="btn btn-success" style="margin-right: 10px">
                + THÊM
            </a>
            <a href="{{ route('admin.employers.verify_list') }}" class="btn btn-warning">Duyệt</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach ($employers as $employer)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $employer->firstname }} {{ $employer->lastname }}</h5>
                            <p><strong>Công ty:</strong> {{ $employer->company->name ?? 'N/A' }}</p>
                            <p><strong>Địa điểm:</strong> {{ $employer->location->name ?? 'N/A' }}</p>
                            <p><strong>Lĩnh vực:</strong> {{ $employer->industry->name ?? 'N/A' }}</p>
                            <p><strong>Điện thoại:</strong> {{ $employer->phone }}</p>
                            <p><strong>Giới tính:</strong>
                                @if ($employer->gender == 'Nam')
                                    Nam
                                @elseif ($employer->gender == 'Nữ')
                                    Nữ
                                @else
                                    Khác
                                @endif
                            </p>
                            <p><strong>Ngày sinh:</strong> {{ $employer->date_of_birth }}</p>
                            <p><strong>Đình chỉ:</strong> {{ $employer->isSuspended == 'yes' ? 'Có' : 'Không' }}</p>
                            <p><strong>Email:</strong> {{ $employer->user->email ?? 'N/A' }}</p>
                            <p><strong>Ngày tạo:</strong> {{ $employer->created_at->format('d-m-Y H:i') }}</p>
                            <p><strong>Ngày cập nhật:</strong> {{ $employer->updated_at->format('d-m-Y H:i') }}</p>

                            <h6>Giờ làm việc:</h6>
                            <ul>
                                <li><strong>Thứ 2:</strong> {{ $employer->hours_monday }}</li>
                                <li><strong>Thứ 3:</strong> {{ $employer->hours_tuesday }}</li>
                                <li><strong>Thứ 4:</strong> {{ $employer->hours_wednesday }}</li>
                                <li><strong>Thứ 5:</strong> {{ $employer->hours_thursday }}</li>
                                <li><strong>Thứ 6:</strong> {{ $employer->hours_friday }}</li>
                                <li><strong>Thứ 7:</strong> {{ $employer->hours_saturday }}</li>
                                <li><strong>Chủ nhật:</strong> {{ $employer->hours_sunday }}</li>
                            </ul>

                            <h6>Social Links:</h6>
                            <ul>
                                <li><strong>Facebook:</strong> <a href="{{ $employer->facebook }}" target="_blank">{{ $employer->facebook }}</a></li>
                                <li><strong>Instagram:</strong> <a href="{{ $employer->instagram }}" target="_blank">{{ $employer->instagram }}</a></li>
                                <li><strong>Github:</strong> <a href="{{ $employer->github }}" target="_blank">{{ $employer->github }}</a></li>
                            </ul>

                            <p><strong>Đã xác thực:</strong> {{ $employer->isverified == 1 ? 'Có' : 'Không' }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.employers.edit', $employer->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.employers.destroy', $employer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $employers->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
