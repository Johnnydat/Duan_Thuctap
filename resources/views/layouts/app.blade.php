<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 60px;
            padding-left: 250px;
            transition: padding-left 0.3s ease;
        }

        body.sidebar-collapsed {
            padding-left: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        #nprogress .bar {
            background: #333;
            height: 2px;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
        }

        .sidebar-overlay {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1015;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 991.98px) {
            body {
                padding-left: 0;
            }
            
            .main-content {
                margin: 15px;
            }
        }
        
        @media (max-width: 767.98px) {
            .main-content {
                margin: 10px;
                padding: 15px;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    @include('admin.partials.nav')
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    @include('admin.partials.sidebar')
    
    <div class="wrapper">
        <main class="main-content">
            @yield('content')
        </main>
        @include('admin.partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    <script>
        // Initialize NProgress
        NProgress.configure({ showSpinner: false });
        window.addEventListener('beforeunload', () => NProgress.start());
        window.addEventListener('load', () => NProgress.done());

        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            sidebarToggle?.addEventListener('click', function() {
                if (window.innerWidth <= 991.98) {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                    sidebarToggle.classList.toggle('active');
                } else {
                    body.classList.toggle('sidebar-collapsed');
                    sidebarToggle.classList.toggle('active');
                }
            });

            sidebarOverlay?.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                sidebarToggle.classList.remove('active');
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 991.98) {
                    sidebar?.classList.remove('show');
                    sidebarOverlay?.classList.remove('show');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>