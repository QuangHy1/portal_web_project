@extends('admin.dashboard.layout')

@section('title', 'Quản lý Feedback Người Dùng')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/user_testimonials/index.css') }}">
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="my-4 ">Feedback Người Dùng</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Ô tìm kiếm và nút Thêm --}}
        <div class="d-flex justify-content-between align-items-center my-3">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('admin.user_testimonials.index') }}" method="GET"
                      class="input-group input-group-navbar input-search-acc">
                    <input type="text" name="keyword" class="form-control form-control-search"
                           placeholder="Tìm kiếm đánh giá..." value="{{ $keyword ?? '' }}">
                    <button class="btn btn-search" type="submit">
                        <i class='bx bx-search-alt'></i>
                    </button>
                </form>
            </div>
            <a href="{{ route('admin.user_testimonials.create') }}" class="btn btn-success">
                + THÊM
            </a>
        </div>

        {{-- Danh sách Feedback --}}
        <div class="row">
            @forelse ($userTestimonials as $testimonial)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center mb-3">
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/uploads/testimonials/' . $testimonial->image) }}" alt="image" class="rounded-circle me-3" width="50" height="50">
                            @else
                                <i class='bx bxs-user-circle' style="font-size:50px; color:#b2bec3; margin-right:15px;"></i>
                            @endif
                            <div>
                                <h5 class="mb-0">
                                    {{ $testimonial->employee->firstname ?? '' }} {{ $testimonial->employee->lastname ?? '' }}
                                </h5>
                                <small class="text-muted">
                                    {{ $testimonial->employee->email ?? '' }}
                                </small>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <p class="text-truncate-multiline">
                                "{{ $testimonial->testimonial }}"
                            </p>
                        </div>

                        <div class="mt-3">
                            <a>Nổi bật: </a>
                            <span class="badge
                                @if($testimonial->isFeatured) bg-success
                                @else bg-secondary
                                @endif">
                                {{ $testimonial->isFeatured ? 'Có' : 'Không' }}
                            </span>
                            <small class="text-muted d-block mt-1">Ngày gửi: {{ $testimonial->created_at->format('d/m/Y') }}</small>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('admin.user_testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-primary">
                                Sửa
                            </a>
                            <form action="{{ route('admin.user_testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa phản hồi này?')">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Không tìm thấy đánh giá nào.</p>
            @endforelse
        </div>

        {{-- Phân trang --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $userTestimonials->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
