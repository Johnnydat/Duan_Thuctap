@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Form bên trái -->
        <div class="col-md-4">
            <div class="form-header mb-3">
                <h4 class="form-title">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span id="form-title-text">Thêm danh mục</span>
                </h4>
            </div>
            
            <form id="category-form" class="enhanced-form" method="POST">
                @csrf
                <input type="hidden" name="_method" id="form_method" value="POST" />
                <input type="hidden" id="editing_id" value="" />

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-tag me-1"></i>
                        Tên danh mục
                    </label>
                    <input type="text" name="name" id="name" class="form-control enhanced-input" 
                           placeholder="Nhập tên danh mục" required>
                    <div class="input-focus-line"></div>
                </div>

                <div class="form-group">
                    <label for="parent_id" class="form-label">
                        <i class="fas fa-sitemap me-1"></i>
                        Danh mục cha
                    </label>
                    <select name="parent_id" id="parent_id" class="form-select enhanced-select">
                        <option value="">-- Không chọn --</option>
                        {!! $categoryOptions !!}
                    </select>
                    <div class="select-focus-line"></div>
                </div>

                <button type="submit" class="btn enhanced-submit-btn w-100">
                    <span class="btn-text">Thêm</span>
                    <i class="fas fa-arrow-right btn-icon"></i>
                </button>
            </form>

            <div id="message" class="mt-3"></div>
        </div>

        <!-- Bảng bên phải -->
        <div class="col-md-8">
            <div class="table-header mb-3">
                <h4 class="table-title">
                    <i class="fas fa-list me-2"></i>
                    Danh sách danh mục
                </h4>
            </div>
            
            <div class="enhanced-table-container">
                <table class="table enhanced-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-tag me-1"></i>Tên</th>
                            <th><i class="fas fa-link me-1"></i>Slug</th>
                            <th><i class="fas fa-sitemap me-1"></i>Danh mục cha</th>
                            <th><i class="fas fa-cogs me-1"></i>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="category-list">
                        @foreach($categories as $cat)
                        <tr class="table-row">
                            <td class="id-cell">{{ $cat->id }}</td>
                            <td class="name-cell">{{ $cat->name }}</td>
                            <td class="slug-cell">{{ $cat->slug }}</td>
                            <td class="parent-cell">{{ $cat->parent ? $cat->parent->name : '-' }}</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="btn action-btn edit-btn" data-id="{{ $cat->id }}" 
                                            data-name="{{ $cat->name }}" data-parent-id="{{ $cat->parent_id }}"
                                            title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn action-btn reset-btn reset-form-btn" title="Thêm mới">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" 
                                          class="delete-form d-inline" data-id="{{ $cat->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn action-btn delete-btn" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
            </div>
        </div>
    </div>
</div>
<script>
let editingId = null;

document.getElementById('category-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Add loading state
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;

    // Lấy method động (POST hoặc PUT)
    const method = document.getElementById('form_method').value;

    // URL động: thêm hoặc sửa
    let url = "{{ route('admin.categories.store') }}";
    if (method === 'PUT') {
        url = `/admin/categories/${editingId}`;
    }

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
            },
            body: formData
        });

        const result = await response.json();
        const messageDiv = document.getElementById('message');

        if (result.success) {
            const cat = result.data;
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                width: '400',
                text: result.message,
                timer: 1500,
                showConfirmButton: false
            });

            if (method === 'POST') {
                // Thêm mới: thêm dòng mới lên đầu bảng
                const newRow = `
                    <tr class="table-row new-row">
                        <td class="id-cell">${cat.id}</td>
                        <td class="name-cell">${cat.name}</td>
                        <td class="slug-cell">${cat.slug}</td>
                        <td class="parent-cell">${cat.parent_name ?? '-'}</td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                <button class="btn action-btn edit-btn" data-id="${cat.id}" data-name="${cat.name}" data-parent-id="${cat.parent_id ?? ''}" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn action-btn reset-btn reset-form-btn" title="Thêm mới">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <form action="/admin/categories/${cat.id}" method="POST" class="delete-form d-inline" data-id="${cat.id}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn action-btn delete-btn" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
                document.getElementById('category-list').insertAdjacentHTML('afterbegin', newRow);
                
                // Add animation for new row
                setTimeout(() => {
                    document.querySelector('.new-row').classList.remove('new-row');
                }, 500);
                
            } else {
                // Cập nhật: thay đổi dòng hiện tại trong bảng
                const rows = document.querySelectorAll('#category-list tr');
                let row = null;
                rows.forEach(r => {
                    if (r.children[0] && r.children[0].textContent.trim() == editingId) {
                        row = r;
                    }
                });

                if (row) {
                    row.classList.add('updated-row');
                    row.innerHTML = `
                        <td class="id-cell">${cat.id}</td>
                        <td class="name-cell">${cat.name}</td>
                        <td class="slug-cell">${cat.slug}</td>
                        <td class="parent-cell">${cat.parent_name ?? '-'}</td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                <button class="btn action-btn edit-btn" data-id="${cat.id}" data-name="${cat.name}" data-parent-id="${cat.parent_id ?? ''}" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn action-btn reset-btn reset-form-btn" title="Thêm mới">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <form action="/admin/categories/${cat.id}" method="POST" class="delete-form d-inline" data-id="${cat.id}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn action-btn delete-btn" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    `;
                    
                    setTimeout(() => {
                        row.classList.remove('updated-row');
                    }, 1000);
                }
            }

            // Cập nhật lại select parent_id
            if (cat.options_html) {
                document.getElementById('parent_id').innerHTML = `<option value="">-- Không chọn --</option>` + cat.options_html;
            }

            // Reset form về trạng thái Thêm mới
            resetForm();

            // Re-attach event listeners
            attachEditButtons();
            attachDeleteButtons();
            attachResetButtons();

        } else {
            messageDiv.innerHTML = `<div class="alert alert-danger enhanced-alert">${result.message || 'Có lỗi xảy ra'}</div>`;
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('message').innerHTML = `<div class="alert alert-danger enhanced-alert">Có lỗi xảy ra khi xử lý yêu cầu</div>`;
    } finally {
        // Remove loading state
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
    }
});

function resetForm() {
    const form = document.getElementById('category-form');
    form.reset();
    editingId = null;
    document.getElementById('form_method').value = 'POST';
    document.querySelector('#category-form button[type="submit"] .btn-text').textContent = 'Thêm';
    document.getElementById('form-title-text').textContent = 'Thêm danh mục';
    form.classList.remove('edit-mode');
}
</script>
@endsection

@section('scripts')
<script>
// Hàm gắn event cho nút xóa
function attachDeleteButtons() {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.onclick = function () {
            const form = this.closest('form');
            Swal.fire({
                    title: 'Cảnh báo!',
                    html: `Bạn có chắc chắn muốn <strong>xóa danh mục</strong>"`,
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
        };
    });
}

// Hàm gắn event cho nút sửa
function attachEditButtons() {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.onclick = function () {
            editingId = this.getAttribute('data-id');
            document.getElementById('name').value = this.getAttribute('data-name');
            document.getElementById('parent_id').value = this.getAttribute('data-parent-id') || '';

            document.getElementById('form_method').value = 'PUT';
            document.querySelector('#category-form button[type="submit"] .btn-text').textContent = 'Cập nhật';
            document.getElementById('form-title-text').textContent = 'Chỉnh sửa danh mục';
            document.getElementById('category-form').classList.add('edit-mode');
        };
    });
}

function attachResetButtons() {
    document.querySelectorAll('.reset-form-btn').forEach(button => {
        button.onclick = function () {
            resetForm();
        };
    });
}

// Gắn event ban đầu
attachEditButtons();
attachDeleteButtons();
attachResetButtons();
</script>
@endsection

@section('styles')
<style>
/* Enhanced Form Styles - Reduced Border Radius to 8px */
.enhanced-form {
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    border-radius: 8px; /* Giảm từ 20px xuống 8px */
    padding: 30px;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.1),
        0 1px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
}

.enhanced-form:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 15px 40px rgba(0, 0, 0, 0.15),
        0 5px 15px rgba(0, 0, 0, 0.08);
}

.form-header {
    text-align: center;
    margin-bottom: 25px;
}


.form-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.4rem;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.form-title i {
    color: #3498db;
    font-size: 1.2rem;

}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-label {
    font-weight: 600;
    color: #34495e;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.form-label i {
    color: #3498db;
    font-size: 0.9rem;
}

.enhanced-input, .enhanced-select {
    border: 2px solid #e9ecef;
    border-radius: 8px; /* Giảm từ 12px xuống 8px */
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
    position: relative;
}

.enhanced-input:focus, .enhanced-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    outline: none;
    transform: translateY(-1px);
}

.input-focus-line, .select-focus-line {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #3498db, #2980b9);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.enhanced-input:focus + .input-focus-line,
.enhanced-select:focus + .select-focus-line {
    width: 100%;
}

.enhanced-submit-btn {
    background: linear-gradient(135deg, #3498db, #2980b9);
    border: none;
    border-radius: 8px; /* Giảm từ 12px xuống 8px */
    padding: 14px 24px;
    font-weight: 600;
    font-size: 1rem;
    color: white;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.enhanced-submit-btn:hover {
    background: linear-gradient(135deg, #2980b9, #1f5f8b);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
}

.enhanced-submit-btn.loading {
    pointer-events: none;
}

.enhanced-submit-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.enhanced-submit-btn.loading .btn-text,
.enhanced-submit-btn.loading .btn-icon {
    opacity: 0;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.btn-icon {
    transition: transform 0.3s ease;
}

.enhanced-submit-btn:hover .btn-icon {
    transform: translateX(3px);
}

/* Edit Mode Styles */
.enhanced-form.edit-mode {
    background: linear-gradient(145deg, #fff8e1, #ffecb3);
    border-color: #ffa726;
}

.enhanced-form.edit-mode .enhanced-submit-btn {
    background: linear-gradient(135deg, #ff9800, #f57c00);
}

.enhanced-form.edit-mode .enhanced-submit-btn:hover {
    background: linear-gradient(135deg, #f57c00, #e65100);
}

/* Enhanced Table Styles - Reduced Border Radius to 8px */
.table-header {
    text-align: center;
    margin-bottom: 20px;
}

.table-title {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.4rem;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.table-title i {
    color: #e74c3c;
    font-size: 1.2rem;
}

.enhanced-table-container {
    background: white;
    border-radius: 8px; /* Giảm từ 20px xuống 8px */
    overflow: hidden;
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.1),
        0 1px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.enhanced-table {
    margin: 0;
    border: none;
}

.enhanced-table thead {
    background: linear-gradient(135deg, #34495e, #2c3e50);
    color: white;
}

.enhanced-table thead th {
    border: none;
    padding: 18px 15px;
    font-weight: 600;
    font-size: 0.95rem;
    text-align: center;
    position: relative;
}

.enhanced-table thead th i {
    color: #3498db;
    margin-right: 5px;
}

.enhanced-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f8f9fa;
}

.enhanced-table tbody tr:hover {
    background: linear-gradient(90deg, #f8f9fa, #ffffff);
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.enhanced-table tbody td {
    padding: 15px;
    vertical-align: middle;
    border: none;
    text-align: center;
}

.id-cell {
    font-weight: 700;
    color: #3498db;
    font-size: 0.9rem;
}

.name-cell {
    font-weight: 600;
    color: #2c3e50;
}

.slug-cell {
    font-family: 'Courier New', monospace;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.parent-cell {
    color: #95a5a6;
    font-style: italic;
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 8px; /* Giảm từ 8px xuống 8px (giữ nguyên) */
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 0.85rem;
}

.edit-btn {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
}

.edit-btn:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
}

.reset-btn {
    background: linear-gradient(135deg, #27ae60, #229954);
    color: white;
}

.reset-btn:hover {
    background: linear-gradient(135deg, #229954, #1e8449);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
}

.delete-btn {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.delete-btn:hover {
    background: linear-gradient(135deg, #c0392b, #a93226);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
}

/* Animation for new/updated rows */
.new-row {
    animation: slideInFromTop 0.5s ease-out;
    background: linear-gradient(90deg, #d5f4e6, #ffffff);
}

.updated-row {
    animation: highlightUpdate 1s ease-out;
    background: linear-gradient(90deg, #fff3cd, #ffffff);
}

@keyframes slideInFromTop {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes highlightUpdate {
    0% {
        background: linear-gradient(90deg, #fff3cd, #ffffff);
    }
    100% {
        background: transparent;
    }
}

/* Enhanced Alert Styles */
.enhanced-alert {
    border-radius: 8px; /* Giảm từ 12px xuống 8px */
    border: none;
    padding: 10px 10px;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .enhanced-form {
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }
    
    .action-btn {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }
    
    .enhanced-table {
        font-size: 0.85rem;
    }
    
    .enhanced-table thead th,
    .enhanced-table tbody td {
        padding: 10px 8px;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .enhanced-form {
        background: linear-gradient(145deg, #2c3e50, #34495e);
        color: white;
    }
    
    .enhanced-input, .enhanced-select {
        background: #34495e;
        border-color: #4a5f7a;
        color: white;
    }
    
    .enhanced-table-container {
        background: #2c3e50;
    }
    
    .enhanced-table tbody tr:hover {
        background: linear-gradient(90deg, #34495e, #2c3e50);
    }
}

    /* Custom SweetAlert Styles - Chung cho cả restore và delete */
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
</style>
@endsection