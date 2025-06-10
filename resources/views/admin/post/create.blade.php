@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center">Thêm mới bài viết</h2>

    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{--  Title --}}
            <div class="col-md-12 mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- slug  --}}
            <div class="col-md-12">
                <label class="form-label">Slug </label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                    value="{{ old('slug') }}" placeholder ="Nhập slug">
                @error('slug')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror
            </div>

            {{-- Content --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Nội dung</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                    placeholder="Nhập nội dung liên hệ">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror
            </div>

            {{-- Thumbnail --}}
            <div class="col-md-6">
                <label class="form-label">Ảnh đại diện</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                @error('thumbnail')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror
            </div>

            {{-- is_published --}}
            <div class="col-md-6">
                <label class="form-label">Trạng thái</label>
                <select name="is_published" class="form-select @error('is_published') is-invalid @enderror">
                    <option value="1">Công khai</option>
                    <option value="0">Riêng tư</option>
                </select>
                @error('is_published')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror

            </div>
            {{-- published_at   --}}
            <div class="col-md-6">
                <label class="form-label">Ngày đăng</label>
                <input type="date" name="published_at"
                    class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at') }}">
                @error('published_at')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror

            </div>

            {{-- Submit --}}
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
                <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>

    </form>
    {{-- Summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 400,
                placeholder: 'Nhập nội dung liên hệ'
            });
        });
    </script>
@endsection
