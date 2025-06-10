@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold text-primary">Danh sách bài viết</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-success d-flex align-items-center">
                            <i class="fas fa-plus-circle me-1"></i> Thêm mới
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">STT</th>
                                    <th style="min-width: 200px;">Tiêu đề</th>
                                    <th style="min-width: 150px;">Slug</th>
                                    <th class="text-center" style="width: 120px;">Thumbnail</th>
                                    <th class="text-center" style="width: 100px;">Trạng thái</th>
                                    <th class="text-center" style="width: 120px;">Ngày đăng</th>
                                    <th class="text-center" style="width: 150px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $index => $post)
                                    <tr class="post-row">
                                        <td class="text-center">{{ ($posts->currentPage() - 1) * $posts->perPage() + $index + 1 }}</td>
                                        <td class="fw-medium">{{ $post->title }}</td>
                                        <td class="text-muted small">{{ $post->slug }}</td>
                                        <td class="text-center">
                                            @if ($post->thumbnail)
                                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Ảnh bài viết"
                                                    class="img-thumbnail rounded shadow-sm" style="width:80px; height:60px; object-fit:cover;">
                                            @else
                                                <span class="badge bg-light text-secondary">Không có ảnh</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($post->is_published)
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                    <i class="fas fa-check-circle me-1"></i> Công khai
                                                </span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">
                                                    <i class="fas fa-lock me-1"></i> Riêng tư
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($post->published_at)
                                                <span class="badge bg-light text-dark border">
                                                    <i class="far fa-calendar-alt me-1"></i>
                                                    {{ $post->published_at->format('d/m/Y') }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-sm btn-info" 
                                                   data-bs-toggle="tooltip" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-sm btn-primary"
                                                   data-bs-toggle="tooltip" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST"
                                                    class="delete-form d-inline" data-id="{{ $post->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            data-bs-toggle="tooltip" title="Xóa bài viết">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">Không có bài viết nào.</p>
                                                <a href="{{ route('admin.post.create') }}" class="btn btn-sm btn-primary mt-3">
                                                    <i class="fas fa-plus-circle me-1"></i> Tạo bài viết mới
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($posts->count() > 0)
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-center">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                delay: { show: 300, hide: 100 }
            });
        });
    });

    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const postId = form.getAttribute('data-id');

            Swal.fire({
                    title: 'Cảnh báo!',
                    html: `Bạn có chắc chắn muốn <strong>xóa bài viết</strong>"`,
                    icon: 'warning',
                    iconColor: '#dc3545',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Xóa ngay',
                    cancelButtonText: '<i class="fas fa-times me-1"></i> Hủy',
                    reverseButtons: true,
                    width: '400px',
                    customClass: {
                        popup: 'category-trash-alert'
                    }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<style>
    /* Table styling */
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .post-row {
        transition: all 0.2s ease;
    }
    
    .post-row:hover {
        background-color: rgba(0, 123, 255, 0.03);
    }
    
    /* Button styling */
    .btn {
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
    }
    
    /* Pagination styling */
    .pagination {
        margin-bottom: 0;
    }
    
    .page-item.active .page-link {
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }
    
    .page-link {
        border-radius: 5px;
        margin: 0 2px;
    }
    
    /* SweetAlert custom styling */
       .swal2-container .category-trash-alert.swal2-popup {
        width: 400px !important;
        font-size: 18px !important;
        padding: 10px !important;
    }

    .swal2-container .category-trash-alert .swal2-title {
        font-size: 20px !important;
        font-weight: bold !important;
    }

    .swal2-container .category-trash-alert .swal2-html-container {
        font-size: 14px !important;
        margin-bottom: 10px !important;
    }

    .swal2-container .category-trash-alert .swal2-icon {
        width: 80px !important;
        height: 80px !important;
        margin: 0 auto !important;
    }

    .swal2-container .category-trash-alert .swal2-actions {
        gap: 10px !important;
        margin: 0 !important;
    }

    .swal2-container .category-trash-alert .swal2-styled {
        padding: 8px 16px !important;
        font-size: 13px !important;
    }
    
    /* Card styling */
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
    }
    
    /* Image styling */
    .img-thumbnail {
        transition: transform 0.2s;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
</style>
@endsection
