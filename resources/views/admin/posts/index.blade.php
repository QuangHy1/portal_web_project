@extends('admin.dashboard.layout')

@section('title', 'Quản lý Bài viết')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/posts/index.css') }}">
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="my-4 ">Danh sách Bài viết</h2>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.posts.index') }}" method="GET" class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search" placeholder="Tìm kiếm bài viết..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>

            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($post->image)
                            <img src="{{ asset('storage/uploads/posts/' . $post->image) }}" class="card-img-top" alt="Ảnh bài viết" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">Không có ảnh</span>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="text-muted small mb-2">Tác giả: {{ $post->editor->full_name ?? 'N/A' }}</p>

                            <div class="text-start small flex-grow-1">
                                <p><strong>Slug:</strong> {{ $post->slug }}</p>
                                <p><strong>Trạng thái:</strong>
                                    @if ($post->status == 'published')
                                        <span class="badge bg-success">Đã xuất bản</span>
                                    @elseif ($post->status == 'draft')
                                        <span class="badge bg-secondary">Bản nháp</span>
                                    @elseif ($post->status == 'pending')
                                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                    @else
                                        {{ $post->status }}
                                    @endif
                                </p>
                                <p><strong>Lượt xem:</strong> {{ $post->view_count }}</p>
                                <p><strong>Danh mục:</strong> {{ $post->category }}</p>
                                <p><strong>Tags:</strong> {{ $post->tags }}</p>
                                <p><strong>Nội dung:</strong> {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 80) }}</p>
                            </div>

                            <div class="mt-3">
                                <small class="text-muted">Cập nhật: {{ $post->updated_at->format('d/m/Y') }}</small>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline">
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

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->appends(['keyword' => $keyword ?? ''])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
