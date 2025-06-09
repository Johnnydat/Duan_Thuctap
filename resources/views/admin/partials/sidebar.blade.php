<nav class="admin-sidebar" id="adminSidebar">
    <div class="position-sticky pt-3 px-3">
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-home me-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-box-open me-3"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-folder-open me-3"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-image me-3"></i>
                    <span>Sliders</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-users me-3"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-shopping-cart me-3"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-comments me-3"></i>
                    <span>Comments</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-tags me-3"></i>
                    <span>News Categories</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center" href="">
                    <i class="fas fa-newspaper me-3"></i>
                    <span>News</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
.admin-sidebar {
    position: fixed;
    top: 60px;
    left: 0;
    width: 250px;
    height: calc(100vh - 60px);
    background-color: white;
    border-right: 1px solid #e0e0e0;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    overflow-y: auto;
    z-index: 1020;
    transition: all 0.3s ease;
    padding-top: 1rem;
}

.admin-sidebar .nav-link {
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    margin-bottom: 0.2rem;
    color: #555;
    font-weight: 500;
    transition: all 0.2s ease;
}

.admin-sidebar .nav-link:hover {
    background-color: #f8f9fa;
    color: #333;
    transform: translateX(4px);
}

.admin-sidebar .nav-link.active {
    background-color: #f0f0f0;
    color: #000;
    font-weight: 600;
    border-left: 3px solid #333;
}

.admin-sidebar .nav-link i {
    color: #666;
    width: 20px;
    text-align: center;
}

.admin-sidebar::-webkit-scrollbar {
    width: 6px;
}

.admin-sidebar::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 3px;
}

body.sidebar-collapsed .admin-sidebar {
    width: 0;
    overflow: hidden;
}

@media (max-width: 991.98px) {
    .admin-sidebar {
        left: -250px;
    }
    .admin-sidebar.show {
        left: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.admin-sidebar .nav-link');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
        
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>