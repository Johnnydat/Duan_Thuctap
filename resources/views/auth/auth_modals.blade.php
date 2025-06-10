<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .btn-login,
    .btn-register {
        width: 100%;
        border-radius: 20px;
        background: #333;
        color: #fff;
        font-weight: 500;
        margin-top: 1rem;
        transition: background 0.2s;
    }

    .btn-login:hover,
    .btn-register:hover {
        background: #222;
        color: #fff;
    }

    .btn-social {
        border: 1px solid #e0e0e0;
        background: #f5f5f5;
        color: #333;
        border-radius: 8px;
        margin: 0 0.5rem 0 0;
        padding: 0.375rem 1rem;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-social:hover {
        background: #e0e0e0;
        color: #111;
    }

    .modal-content {
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.10);
        border: 1px solid #e0e0e0;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-weight: 600;
        color: #222;
    }

    .divider {
        text-align: center;
        margin: 1.5rem 0 1rem;
        position: relative;
    }

    .divider span {
        background: #fff;
        padding: 0 1rem;
        color: #888;
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }

    .divider:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        height: 1px;
        background: #e0e0e0;
        z-index: 0;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .register-link,
    .login-link {
        margin-top: 1.25rem;
        text-align: center;
        font-size: 0.95rem;
    }

    .input-group .form-control {
        border-radius: 14px 0 0 14px;
        border-right: none;
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
    }

    .input-group-text {
        border-radius: 0 14px 14px 0;
        background: #f5f5f5;
        border: 1px solid #e0e0e0;
        border-left: none;
        cursor: pointer;
    }

    .password-toggle i {
        color: #888;
    }

    .form-check-label,
    .form-label {
        color: #555;
        font-weight: 500;
    }

    .form-check-input:checked {
        background-color: #333;
        border-color: #333;
    }

    @media (max-width: 767.98px) {
        .modal-dialog {
            margin: 1rem;
        }
    }
</style>

<!-- Modal Đăng Nhập -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Chào mừng trở lại!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-0">
                <div id="loginErrors"></div>
                <form id="loginForm" action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                            <span class="input-group-text password-toggle"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="form-check d-flex mb-3 justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>
                    <button type="submit" class="btn btn-login text-white">Đăng nhập</button>
                    <div class="divider"><span>hoặc đăng nhập bằng</span></div>
                    <div class="social-login">
                        <button type="button" class="btn btn-social"><i class="fab fa-google"></i> Google</button>
                        <button type="button" class="btn btn-social"><i class="fab fa-facebook-f"></i> Facebook</button>
                    </div>
                    <div class="register-link">
                        Chưa có tài khoản? <a href="#" class="text-decoration-none" id="showRegister">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Đăng Ký -->
<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Tạo tài khoản mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-0">
                <div id="registerErrors"></div>
                <form id="registerForm" action="{{ route('register') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Họ và tên *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mật khẩu *</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Xác nhận mật khẩu *</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="gender">
                                <option value="">Chọn giới tính</option>
                                <option value="M">Nam</option>
                                <option value="F">Nữ</option>
                                <option value="O">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms">
                        <label class="form-check-label" for="agreeTerms">
                            Tôi đồng ý với <a href="#">điều khoản sử dụng</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-register text-white">Đăng ký</button>
                    <div class="login-link">
                        Đã có tài khoản? <a href="#" class="text-decoration-none" id="showLogin">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script chuyển đổi + toggle password + Ajax -->
<script>
    // Toggle mật khẩu
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    // Chuyển đổi modal
    document.getElementById('showRegister')?.addEventListener('click', function (e) {
        e.preventDefault();
        bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
        setTimeout(() => new bootstrap.Modal(document.getElementById('registerModal')).show(), 300);
    });

    document.getElementById('showLogin')?.addEventListener('click', function (e) {
        e.preventDefault();
        bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
        setTimeout(() => new bootstrap.Modal(document.getElementById('loginModal')).show(), 300);
    });

    // AJAX Đăng ký
    document.getElementById('registerForm')?.addEventListener('submit', async function (e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const errorContainer = document.getElementById('registerErrors');
        const originalBtnText = submitBtn.innerHTML;

        try {
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Đang đăng ký...';
            submitBtn.disabled = true;
            errorContainer.innerHTML = '';

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();
            if (response.ok) {
                window.location.reload();
            } else {
                let errorHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                if (data.errors) {
                    for (const key in data.errors) {
                        data.errors[key].forEach(error => {
                            errorHtml += `<li>${error}</li>`;
                        });
                    }
                } else if (data.message) {
                    errorHtml += `<li>${data.message}</li>`;
                } else {
                    errorHtml += '<li>Đăng ký thất bại. Vui lòng thử lại.</li>';
                }
                errorHtml += '</ul></div>';
                errorContainer.innerHTML = errorHtml;
            }
        } catch (err) {
            errorContainer.innerHTML = '<div class="alert alert-danger">Đã xảy ra lỗi. Vui lòng thử lại.</div>';
        } finally {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        }
    });
</script>
