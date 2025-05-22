@extends('Frontend.layouts.masterDashboard')
@section('page_title')#1 Job Portal Company @endsection
@section('header_shadow')head-shadow @endsection
@section('body_content')
    @include('Frontend.layouts.employeeDashboardNav')

    <div class="dashboard-content">
        <div class="dashboard-tlbar d-block mb-5">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <h1 class="ft-medium">Upload Hồ Sơ (CVs)</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-muted"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item text-muted"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="theme-cl">Thêm CVs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="dashboard-widg-bar d-block">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="_dashboard_content bg-white rounded mb-4">
                        <div class="_dashboard_content_header br-bottom py-3 px-3">
                            <div class="_dashboard__header_flex">
                                <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-file mr-1 theme-cl fs-sm"></i>Thêm CVs</h4>
                            </div>
                        </div>

                        <div class="_dashboard_content_body py-3 px-3">
                                <form action="{{ route('employee.resumes.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cvTitle" class="text-dark ft-medium">Tiêu đề CV (tuỳ chọn)</label>
                                        <input type="text" name="title" class="form-control" placeholder="VD: CV xin việc vị trí lập trình viên">
                                    </div>
                                    <div class="form-group">
                                        <label for="cvFile" class="text-dark ft-medium">Chọn file CV</label>
                                        <input type="file" name="cv_file" class="form-control" required accept=".pdf,.doc,.docx">
                                        <small class="text-muted">Chấp nhận định dạng PDF, DOC, DOCX.</small>
                                    </div>
                                    <button type="submit" class="btn btn-md ft-medium text-light rounded theme-bg">Tải lên</button>
                                </form>
                        </div>
                    </div>

                    <div class="_dashboard_content bg-white rounded">
                        <div class="_dashboard_content_header br-bottom py-3 px-3">
                            <h4 class="mb-0 ft-medium fs-md"><i class="fa fa-folder-open mr-1 theme-cl fs-sm"></i>Danh sách CV đã tải lên</h4>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="_dashboard_content_body py-3 px-3">
                            @if(count($resumes) > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>STT</th>
                                            <th>Tiêu đề</th>
                                            <th>Tên file</th>
                                            <th>Định dạng</th>
                                            <th>Ngày tải lên</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($resumes as $index => $resume)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $resume->title ?? '(Không có)' }}</td>
                                                <td>{{ $resume->file_name }}</td>
                                                <td>{{ strtoupper($resume->file_type) }}</td>
                                                <td>{{ $resume->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $resume->file_path) }}" class="btn btn-sm btn-info" target="_blank">Xem</a>

                                                    <a href="{{ route('employee.resumes.download', $resume->id) }}" class="btn btn-sm btn-success">Tải</a>
                                                    <form action="{{ route('employee.resumes.destroy', $resume->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá CV này không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Bạn chưa tải lên CV nào.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
