@extends('admin.dashboard.layout')

@section('title', 'Danh sách Editor')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/editors/index.css') }}">
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="text-center">Danh sách Editor</h2>

        <div class="d-flex justify-content-center mb-4">
            <form action="{{ route('admin.editors.index') }}" method="GET" class="input-group input-group-navbar input-search-acc w-75">
                <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm người chỉnh sửa..." value="{{ request('keyword') }}" />
                <button class="btn btn-search" type="submit">
                    <i class='bx bx-search-alt'></i>
                </button>
            </form>
        </div>

        <div class="row">
            @foreach ($editors as $index => $editor)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            @if ($editor->avatar)
                                <img src="{{ asset('storage/uploads/editors/' . $editor->avatar) }}" alt="Avatar" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="mb-3 text-muted">Không có ảnh</div>
                            @endif

                            <h5 class="card-title">{{ $editor->full_name }}</h5>
                            <p class="text-muted small mb-1">@ {{ $editor->user->username ?? 'N/A' }}</p>
                            <p class="text-muted small">{{ $editor->user->email ?? 'N/A' }}</p>

                            <div class="mt-3 text-start small">
                                <p><strong>Giới tính:</strong> {{ $editor->gender === 'male' ? 'Nam' : ($editor->gender === 'female' ? 'Nữ' : 'Khác') }}</p>
                                <p><strong>Ngày sinh:</strong> {{ $editor->date_of_birth }}</p>
                                <p><strong>Điện thoại:</strong> {{ $editor->phone }}</p>
                                <p><strong>Địa chỉ:</strong> {{ $editor->address }}</p>
                                <p><strong>Vị trí:</strong> {{ $editor->location->name ?? 'N/A' }}</p>
                                <p><strong>Số bài viết:</strong> {{ $editor->post_count }}</p>
                                <p><strong>Bio:</strong> {{ \Illuminate\Support\Str::limit($editor->bio, 80) }}</p>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.editors.edit', $editor->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.editors.destroy', $editor->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $editors->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
