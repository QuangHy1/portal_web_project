@extends('admin.dashboard.layout')

@section('title', 'Chỉnh sửa Bài viết')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/css/posts/edit.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Chỉnh sửa Bài viết</h2>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="editor_id" class="form-label">Tác giả</label>
                <select class="form-select" id="editor_id" name="editor_id" required>
                    <option value="">-- Chọn tác giả --</option>
                    @foreach ($editors as $editor)
                        <option value="{{ $editor->id }}" {{ old('editor_id', $post->editor_id) == $editor->id ? 'selected' : '' }}>
                            {{ $editor->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('editor_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" required>
                @error('slug')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $post->status) }}">
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @if ($post->image)
                    <img src="{{ asset('storage/uploads/posts/' . $post->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="view_count" class="form-label">Lượt xem</label>
                <input type="number" class="form-control" id="view_count" name="view_count" value="{{ old('view_count', $post->view_count) }}" min="0">
                @error('view_count')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Danh mục</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $post->category) }}">
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $post->tags) }}">
                @error('tags')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
