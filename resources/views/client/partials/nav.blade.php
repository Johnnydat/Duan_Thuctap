<style>
    /* Main Navbar Styles */
    .main-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 72px;
        z-index: 1000;
        background-color: white;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 0 2rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .navbar-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Logo Styles */
    .navbar-brand {
        font-weight: 700;
        color: #111 !important;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-brand i {
        color: #ff6b6b;
    }

    /* Navigation Links */
    .nav-links {
        display: flex;
        gap: 1.5rem;
        margin: 0 2rem;
    }

    .nav-link {
        color: #333;
        font-weight: 500;
        text-decoration: none;
        position: relative;
        padding: 0.5rem 0;
        transition: color 0.2s;
    }

    .nav-link:hover {
        color: #000;
    }

    .nav-link.active {
        color: #000;
        font-weight: 600;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #ff6b6b;
    }

    /* Search Box */
    .search-container {
        display: flex;
        align-items: center;
        flex-grow: 1;
        max-width: 400px;
    }

    .search-input {
        border: 1px solid #e0e0e0;
        border-radius: 24px;
        padding: 0.5rem 1.25rem;
        width: 100%;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: #ff6b6b;
        box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cart-btn {
        position: relative;
        background: none;
        border: none;
        cursor: pointer;
        color: #333;
        font-size: 1.25rem;
        padding: 0.5rem;
    }

    .cart-count {
        position: absolute;
        top: -2px;
        right: -2px;
        background: #ff6b6b;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem 0.5rem;
        border-radius: 24px;
        transition: background 0.2s;
    }

    .user-btn:hover {
        background: #f5f5f5;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #555;
    }

    .user-name {
        font-weight: 500;
        font-size: 0.95rem;
    }

    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        min-width: 200px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.2s;
        z-index: 100;
    }

    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.65rem 1.25rem;
        color: #333;
        text-decoration: none;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background: #f8f8f8;
        color: #000;
    }

    .dropdown-item i {
        width: 20px;
        text-align: center;
        color: #777;
    }

    .dropdown-divider {
        height: 1px;
        background: #eee;
        margin: 0.25rem 0;
    }

    /* Login Button */
    .login-btn {
        background: #ff6b6b;
        color: white;
        border: none;
        border-radius: 24px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .login-btn:hover {
        background: #ff5252;
        transform: translateY(-1px);
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .nav-links {
            display: none;
        }

        .search-container {
            margin: 0 1rem;
        }
    }

    @media (max-width: 768px) {
        .main-navbar {
            padding: 0 1rem;
            height: 60px;
        }

        .search-container {
            display: none;
        }

        .user-name {
            display: none;
        }
    }
</style>

<?php
if (Auth::check()) {
    $user = Auth::user();
    $avatar = $user->avatar ?? null;
    $cartCount = 0;
    // $cartCount = $user->carts->sum('quantity') ?? 0;
} else {
    $avatar = null;
    $cartCount = 0;
}
?>

<nav class="main-navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <i class="fas fa-shoe-prints"></i> Tlo Fashion
        </a>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="#" class="nav-link active">Trang chủ</a>
            <a href="#" class="nav-link">Sản phẩm</a>
            <a href="#" class="nav-link">Bộ sưu tập</a>
            <a href="#" class="nav-link">Giới thiệu</a>
            <a href="#" class="nav-link">Liên hệ</a>
        </div>

        <!-- Search Box -->
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Tìm kiếm giày...">
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <!-- Cart Button -->
            <button class="cart-btn">
                <i class="fas fa-shopping-bag"></i>
                @if($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </button>

            <!-- User Dropdown or Login Button -->
            @auth
                <div class="user-dropdown" id="userDropdown">
                    <button class="user-btn" id="userBtn">
                        @if($avatar)
                            <img src="{{ asset('storage/' . $avatar) }}" class="user-avatar" alt="User Avatar">
                        @else
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </button>

                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i> Hồ sơ
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-shopping-cart"></i> Đơn hàng
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-heart"></i> Yêu thích
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i> Cài đặt
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Đăng nhập
                </button>
            @endauth
        </div>
    </div>
</nav>

@include('auth.auth_modals')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    @if (!empty($showLoginModal))
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var loginModalEl = document.getElementById('loginModal');
                if (loginModalEl) {
                    var loginModal = new bootstrap.Modal(loginModalEl);
                    loginModal.show();
                }
            }, 300);
        });
    @endif
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('needLogin'))
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        @endif

        @if (session('messageLogin'))
            alert('{{ session('messageLogin') }}');
        @endif

// Dropdown menu toggle
const userBtn = document.getElementById('userBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (userBtn && dropdownMenu) {
            userBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!dropdownMenu.contains(e.target) && !userBtn.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }
    });
</script>