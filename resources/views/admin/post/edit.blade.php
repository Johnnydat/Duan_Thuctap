@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center">Chỉnh sửa bài viết</h2>

    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- Title --}}
            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                    value="{{ old('slug', $post->slug) }}" placeholder="Nhập slug">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Content --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Nội dung</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                    placeholder="Nhập nội dung" style="min-height: 400px;">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Thumbnail --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                    accept="image/*">
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                {{-- Hiển thị ảnh hiện tại nếu có --}}
                @if ($post->thumbnail)
                    <div class="mt-2">
                        <p class="text-muted">Ảnh hiện tại:</p>
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="Current thumbnail" class="img-thumbnail"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
            </div>

            {{-- Published Status --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Trạng thái</label>
                <div class="form-check">
                    <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1"
                        {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">
                        Xuất bản
                    </label>
                </div>
            </div>

            {{-- Published Date --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Ngày xuất bản</label>
                <input type="datetime-local" name="published_at"
                    class="form-control @error('published_at') is-invalid @enderror"
                    value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit Buttons --}}
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
{{-- Summernote --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        $('#content').summernote({
            height: 400,
            placeholder: 'Nhập nội dung'
        });
    });
</script>
@endsection
