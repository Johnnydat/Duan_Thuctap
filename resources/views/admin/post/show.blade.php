@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center">Chi tiết bài viết</h2>

    <div class="row">
        {{-- Title --}}
        <div class="col-md-12 mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" readonly>
        </div>

        {{-- Slug --}}
        <div class="col-md-12">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $post->slug }}" readonly>
        </div>

        {{-- Content --}}
        <div class="col-md-12 mb-3">
            <label class="form-label">Nội dung</label>
            <div class="form-control" style="min-height: 400px; white-space: pre-wrap;">
                {!! $post->content !!}
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="col-md-6">
            <label class="form-label">Hình ảnh</label>
            @if ($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Ảnh bài viết" class="img-thumbnail"
                    style="width: 100%; height: auto; object-fit: cover;">
            @else
                <span class="text-muted">Không có hình ảnh</span>
            @endif
        </div>
        {{-- is_published --}}
        <div class="col-md-6">
            <label class="form-label">Trạng thái</label>
            <select name="is_published" class="form-select" disabled>
                <option value="1" {{ $post->is_published ? 'selected' : '' }}>Công khai</option>
                <option value="0" {{ !$post->is_published ? 'selected' : '' }}>Riêng tư</option>
            </select>
        </div>
        {{-- Published At --}}
        <div class="col-md-6">
            <label class="form-label">Ngày đăng</label>
            <input type="text" name="published_at" class="form-control"
                value="{{ $post->published_at ? $post->published_at->format('d/m/Y') : 'Chưa đăng' }}" readonly>
        </div>
        {{-- Created At --}}
        <div class="col-md-6">
            <label class="form-label">Ngày tạo</label>
            <input type="text" name="created_at" class="form-control"
                value="{{ $post->created_at->format('d/m/Y H:i') }}" readonly>
        </div>
        {{-- Updated At --}}
        <div class="col-md-6">
            <label class="form-label">Ngày cập nhật</label>
            <input type="text" name="updated_at" class="form-control"
                value="{{ $post->updated_at->format('d/m/Y H:i') }}" readonly>
        </div>
        <div class="col-md-12">
            <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>

    </div>
@endsection
