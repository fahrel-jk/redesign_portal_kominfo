<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - CMS Kominfo Jatim</title>
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Sidebar */
        .cms-sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            width: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 40;
            transition: transform 0.25s ease;
        }
        @media (max-width: 1023px) {
            .cms-sidebar { transform: translateX(-100%); }
            .cms-sidebar.open { transform: translateX(0); }
        }
        
        .cms-sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .cms-sidebar .nav-item:hover {
            background: #f1f5f9;
            color: #334155;
        }
        .cms-sidebar .nav-item.active {
            background: #1d4ed8;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(29, 78, 216, 0.25);
        }
        .cms-sidebar .nav-item.active svg { color: #ffffff; }
        .cms-sidebar .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }
        
        /* Main content offset for sidebar */
        .cms-main {
            margin-left: 260px;
            min-height: 100vh;
            background: #f8fafc;
        }
        @media (max-width: 1023px) {
            .cms-main { margin-left: 0; }
        }
        
        /* Top bar */
        .cms-topbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 30;
        }
        
        /* Page content */
        .cms-content {
            padding: 28px 32px;
        }
        
        /* Toast notifications */
        .cms-toast {
            animation: slideInDown 0.3s ease;
        }
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Overlay for mobile sidebar */
        .cms-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 35;
        }
        .cms-overlay.active { display: block; }

        /* Profile dropdown */
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            min-width: 220px;
            padding: 6px;
            z-index: 50;
        }
        .profile-dropdown.open { display: block; }
        .profile-dropdown a,
        .profile-dropdown button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            width: 100%;
            text-align: left;
            transition: background 0.1s;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
        }
        .profile-dropdown a:hover,
        .profile-dropdown button:hover { background: #f1f5f9; }
        .profile-dropdown .danger { color: #dc2626; }
        .profile-dropdown .danger:hover { background: #fef2f2; }
    </style>
</head>
<body class="antialiased text-slate-700">

    <!-- Mobile overlay -->
    <div class="cms-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="cms-sidebar" id="sidebar">
        <!-- Brand header -->
        <div style="padding: 20px 20px 16px; border-bottom: 1px solid #e2e8f0;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('images/logo_diskominfo-nobg.png') }}" alt="Logo Kominfo" style="height: 36px; width: auto;">
                <div>
                    <div style="font-size: 14px; font-weight: 800; color: #1e293b; letter-spacing: -0.3px;">Kominfo Jatim</div>
                    <div style="font-size: 11px; font-weight: 500; color: #94a3b8;">CMS Portal Layanan</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav style="flex: 1; padding: 12px; overflow-y: auto;">
            <div style="margin-bottom: 20px;">
                <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; padding: 0 16px 8px;">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="bar-chart-3"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div style="margin-bottom: 20px;">
                <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; padding: 0 16px 8px;">Kelola Konten</div>
                <div style="display: flex; flex-direction: column; gap: 2px;">
                    <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i data-lucide="layers"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i data-lucide="layout-grid"></i>
                        <span>Layanan Digital</span>
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i data-lucide="newspaper"></i>
                        <span>Berita</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        <i data-lucide="calendar"></i>
                        <span>Kalender Kegiatan</span>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="nav-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                        <i data-lucide="image"></i>
                        <span>Galeri Foto</span>
                    </a>
                    <a href="{{ route('admin.videos.index') }}" class="nav-item {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                        <i data-lucide="video"></i>
                        <span>Video YouTube</span>
                    </a>
                </div>
            </div>

            <div>
                <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; padding: 0 16px 8px;">Pengaturan</div>
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i data-lucide="shield-check"></i>
                    <span>Administrator</span>
                </a>
            </div>
        </nav>

        <!-- Sidebar footer -->
        <div style="padding: 12px; border-top: 1px solid #e2e8f0;">
            <a href="{{ route('portal.home') }}" target="_blank" class="nav-item" style="color: #3b82f6;">
                <i data-lucide="external-link"></i>
                <span>Buka Portal Publik</span>
            </a>
        </div>
    </aside>

    <!-- Main area -->
    <div class="cms-main">
        <!-- Top bar -->
        <header class="cms-topbar">
            <div style="display: flex; align-items: center; gap: 16px;">
                <!-- Mobile hamburger -->
                <button onclick="toggleSidebar()" class="lg:hidden" style="background: none; border: none; cursor: pointer; padding: 4px; color: #475569;">
                    <i data-lucide="menu" style="width: 22px; height: 22px;"></i>
                </button>
                
                <!-- Breadcrumb -->
                <nav style="display: flex; align-items: center; gap: 6px; font-size: 13px;">
                    <a href="{{ route('admin.dashboard') }}" style="color: #94a3b8; text-decoration: none; font-weight: 600;">CMS</a>
                    @hasSection('breadcrumb')
                        <i data-lucide="chevron-right" style="width: 14px; height: 14px; color: #cbd5e1;"></i>
                        @yield('breadcrumb')
                    @endif
                </nav>
            </div>

            <!-- Profile -->
            <div style="position: relative;" id="profileContainer">
                <button onclick="toggleProfile()" style="display: flex; align-items: center; gap: 10px; background: none; border: 1px solid #e2e8f0; border-radius: 10px; padding: 6px 12px 6px 6px; cursor: pointer; transition: all 0.15s;" onmouseover="this.style.borderColor='#cbd5e1'" onmouseout="this.style.borderColor='#e2e8f0'">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #1d4ed8; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div style="text-align: left; display: none;" class="sm:block" id="profileName">
                        <div style="font-size: 12.5px; font-weight: 700; color: #1e293b; line-height: 1.2;">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div style="font-size: 11px; font-weight: 500; color: #94a3b8; line-height: 1.2;">{{ Auth::user()->role ?? 'admin' }}</div>
                    </div>
                    <i data-lucide="chevron-down" style="width: 14px; height: 14px; color: #94a3b8;"></i>
                </button>

                <div class="profile-dropdown" id="profileDropdown">
                    <div style="padding: 10px 14px 8px; border-bottom: 1px solid #f1f5f9; margin-bottom: 4px;">
                        <div style="font-size: 12px; font-weight: 700; color: #1e293b;">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                    <a href="{{ route('portal.home') }}" target="_blank">
                        <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                        Lihat Portal Publik
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="danger">
                            <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
                            Keluar dari CMS
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content area -->
        <main class="cms-content">
            {{-- Success toast --}}
            @if(session('success'))
                <div class="cms-toast" style="margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 8px; background: #dcfce7; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="check" style="width: 16px; height: 16px; color: #16a34a;"></i>
                        </div>
                        <span style="font-size: 13px; font-weight: 600; color: #15803d;">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; padding: 4px; color: #86efac;">
                        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="cms-toast" style="margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; background: #fef2f2; border: 1px solid #fecaca; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 28px; height: 28px; border-radius: 8px; background: #fee2e2; display: flex; align-items: center; justify-content: center;">
                            <i data-lucide="alert-circle" style="width: 16px; height: 16px; color: #dc2626;"></i>
                        </div>
                        <span style="font-size: 13px; font-weight: 600; color: #b91c1c;">{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; padding: 4px; color: #fca5a5;">
                        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>
            @endif

            @yield('admin-content')
        </main>
    </div>

    <script>
        // Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });

        // Sidebar toggle (mobile)
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        // Profile dropdown
        function toggleProfile() {
            document.getElementById('profileDropdown').classList.toggle('open');
        }
        // Close profile dropdown on click outside
        document.addEventListener('click', (e) => {
            const container = document.getElementById('profileContainer');
            if (container && !container.contains(e.target)) {
                document.getElementById('profileDropdown').classList.remove('open');
            }
        });

        // Auto-hide toast after 5s
        document.querySelectorAll('.cms-toast').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.3s, transform 0.3s';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 300);
            }, 5000);
        });
    </script>
</body>
</html>
