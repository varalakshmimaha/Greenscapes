<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - SR Greenscapes Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-green: #4a7c3f;
            --dark-green: #2d5a27;
            --light-green: #e8f5e3;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f9; }
        .sidebar {
            position: fixed; top: 0; left: 0; width: var(--sidebar-width); height: 100vh;
            background: linear-gradient(180deg, var(--dark-green) 0%, #1a3a15 100%);
            color: #fff; z-index: 1000; overflow-y: auto; transition: all 0.3s;
        }
        .sidebar .brand {
            padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar .brand h4 { margin: 0; font-weight: 700; color: #8bc34a; font-size: 1.3rem; }
        .sidebar .brand small { color: rgba(255,255,255,0.6); font-size: 0.75rem; }
        .sidebar-nav { padding: 15px 0; }
        .sidebar-nav .nav-label {
            padding: 10px 20px 5px; font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 600;
        }
        .sidebar-nav a {
            display: flex; align-items: center; padding: 10px 20px; color: rgba(255,255,255,0.75);
            text-decoration: none; transition: all 0.2s; font-size: 0.9rem; border-left: 3px solid transparent;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(255,255,255,0.1); color: #fff; border-left-color: #8bc34a;
        }
        .sidebar-nav a i { width: 20px; margin-right: 12px; text-align: center; font-size: 0.95rem; }
        .sidebar-nav .nav-dropdown > a.nav-dropdown-toggle { cursor: pointer; display: flex; align-items: center; padding: 10px 20px; color: rgba(255,255,255,0.75); text-decoration: none; transition: all 0.2s; font-size: 0.9rem; border-left: 3px solid transparent; }
        .sidebar-nav .nav-dropdown > a.nav-dropdown-toggle:hover, .sidebar-nav .nav-dropdown.open > a.nav-dropdown-toggle { background: rgba(255,255,255,0.1); color: #fff; border-left-color: #8bc34a; }
        .sidebar-nav .nav-dropdown.open > a.nav-dropdown-toggle i.fa-chevron-down { transform: rotate(180deg); }
        .sidebar-nav .nav-dropdown > a.nav-dropdown-toggle i.fa-chevron-down { transition: transform 0.2s; }
        .sidebar-nav .nav-dropdown-menu { display: none; background: rgba(0,0,0,0.15); }
        .sidebar-nav .nav-dropdown.open .nav-dropdown-menu { display: block; }
        .sidebar-nav .nav-dropdown-menu a { padding: 8px 20px 8px 52px; font-size: 0.85rem; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .top-header {
            background: #fff; padding: 15px 30px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.04); position: sticky; top: 0; z-index: 100;
        }
        .top-header h5 { margin: 0; font-weight: 600; color: #333; }
        .content-wrapper { padding: 30px; }
        .stat-card {
            background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s; border: none;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .icon-box {
            width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem;
        }
        .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; color: #333; }
        .stat-card .stat-label { font-size: 0.85rem; color: #888; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card-header { background: #fff; border-bottom: 1px solid #eee; padding: 15px 20px; border-radius: 12px 12px 0 0 !important; }
        .btn-primary { background: var(--primary-green); border-color: var(--primary-green); }
        .btn-primary:hover { background: var(--dark-green); border-color: var(--dark-green); }
        .btn-success { background: #8bc34a; border-color: #8bc34a; }
        .table th { font-weight: 600; color: #555; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-active { background: #e8f5e3; color: var(--primary-green); }
        .badge-inactive { background: #fde8e8; color: #c0392b; }
        .img-thumbnail-sm { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .drag-handle { cursor: grab; color: #aaa; }
        .drag-handle:active { cursor: grabbing; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <h4><i class="fas fa-leaf"></i> SR GREENSCAPES</h4>
            <small>Admin Panel</small>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-label">Frontend Content</div>
            <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <i class="fas fa-image"></i> Banners
            </a>
            <a href="{{ route('admin.menus.index') }}" class="{{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <i class="fas fa-bars"></i> Navigation Menus
            </a>
            <a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> About Us
            </a>

            {{-- Teams Dropdown --}}
            <div class="nav-dropdown {{ request()->routeIs('admin.team.*') || request()->routeIs('admin.team-categories.*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="nav-dropdown-toggle">
                    <i class="fas fa-users" style="width:20px; margin-right:12px; text-align:center;"></i> Teams <i class="fas fa-chevron-down ms-auto" style="width:auto; margin-right:0; font-size:0.7rem;"></i>
                </a>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('admin.team-categories.index') }}" class="{{ request()->routeIs('admin.team-categories.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i> Categories
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> Members
                    </a>
                </div>
            </div>

            {{-- Service Categories Dropdown --}}
            <div class="nav-dropdown {{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.service-subcategories.*') || request()->routeIs('admin.services.*') ? 'open' : '' }}">
                <a href="javascript:void(0)" class="nav-dropdown-toggle">
                    <i class="fas fa-concierge-bell" style="width:20px; margin-right:12px; text-align:center;"></i> Services <i class="fas fa-chevron-down ms-auto" style="width:auto; margin-right:0; font-size:0.7rem;"></i>
                </a>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="fas fa-list"></i> All Services
                    </a>
                    <a href="{{ route('admin.service-categories.index') }}" class="{{ request()->routeIs('admin.service-categories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder"></i> Categories
                    </a>
                    <a href="{{ route('admin.service-subcategories.index') }}" class="{{ request()->routeIs('admin.service-subcategories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i> Sub Categories
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i> Projects
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Gallery
            </a>
            <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                <i class="fas fa-video"></i> Videos
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i> Blogs
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i> FAQs
            </a>
            <a href="{{ route('admin.counters.index') }}" class="{{ request()->routeIs('admin.counters.*') ? 'active' : '' }}">
                <i class="fas fa-sort-numeric-up"></i> Counters
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-quote-left"></i> Testimonials
            </a>

            <div class="nav-label">Communications</div>
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Contact Messages
                @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unread > 0)
                    <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                @endif
            </a>

            <div class="nav-label">Configuration</div>
            <a href="{{ route('admin.settings.general') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Settings
            </a>

            <div class="nav-label">Frontend</div>
            <a href="/" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>

            <div class="nav-label mt-3"></div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="main-content">
        <header class="top-header">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h5>@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted small">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('admin.settings.general') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="content-wrapper">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        if (typeof $ !== 'undefined' && $.ajaxSetup) { $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } }); }
        // Sidebar dropdown toggle
        document.querySelectorAll('.nav-dropdown-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var dropdown = this.closest('.nav-dropdown');
                // Close other dropdowns
                document.querySelectorAll('.nav-dropdown').forEach(function(d) {
                    if (d !== dropdown) d.classList.remove('open');
                });
                dropdown.classList.toggle('open');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
