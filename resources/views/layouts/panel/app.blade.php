<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.shared.head-meta')

    <style>
    :root {
        --nova-bg: #f8fafc;
        --nova-sidebar-bg: #111827; /* dark sidebar */
        --nova-sidebar-text: #d1d5db;
        --nova-sidebar-muted: #9ca3af;
        --nova-sidebar-active: #6366f1;
        --nova-border: #374151; /* subtle divider */
    }

    body {
        background-color: var(--nova-bg);
        font-size: 15.5px;
    }

    /* ===== Sidebar ===== */
    #sidebar {
        width: 260px;
        min-height: 100vh;
        background: var(--nova-sidebar-bg);
        color: var(--nova-sidebar-text);
        border-right: 1px solid var(--nova-border);
        display: flex;
        flex-direction: column;
    }

    /* Sidebar Brand */
    .sidebar-brand {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        padding-bottom: 0;
        color: #ffffff;
        font-weight: 600;
        border-bottom: 1px solid var(--nova-border);
        text-align: center;
    }

    /* Circle always visible */
    .sidebar-brand .brand-icon {
        width: 40px;
        height: 40px;
        background-color: var(--nova-sidebar-active);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.25rem;
    }

    /* Full text only on desktop */
    .sidebar-brand .brand-text {
        text-align: center;
        margin-top: 0.25rem;
    }

    /* Sidebar Sections */
    .sidebar-section {
        margin-top: 1rem;
    }

    .sidebar-section-label {
        font-size: 0.7rem;
        letter-spacing: 0.08em;
        color: var(--nova-sidebar-muted);
        padding: 0.5rem 1rem;
        border-top: 1px solid var(--nova-border);
    }

    .sidebar-link {
        font-size: 0.875rem;
        color: var(--nova-sidebar-text);
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .sidebar-link:hover,
    .sidebar-link:focus-visible {
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        outline: none;
    }

    .sidebar-link.active {
        background: rgba(99, 102, 241, 0.15);
        color: #ffffff;
        font-weight: 500;
    }

    .sidebar-link i {
        font-size: 0.9rem;
        opacity: 0.85;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        border-top: 1px solid var(--nova-border); 
        padding: 0.75rem 1rem;
        text-align: center;
        margin-top: auto;
    }

    .sidebar-footer .user-name {
        font-size: 0.8rem;
        font-weight: 500;
        color: #ffffff;
    }

    .sidebar-footer .user-role {
        font-size: 0.7rem;
        color: var(--nova-sidebar-muted);
    }

    /* ===== Topbar ===== */
    .topbar {
        height: 56px;
        background: #ffffff;
        padding: 0 0.75rem;
    }

    .breadcrumb {
        font-size: 0.85rem;
        margin-bottom: 0;
        color: #6b7280;
    }

    /* ===== Main content ===== */
    main {
        padding: 1.75rem;
        max-width: 1400px;
    }

    .page-header {
        margin-bottom: 1.25rem;
    }

    .page-header h1 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .page-header p {
        font-size: 0.85rem;
        color: #6b7280;
        margin: 0;
    }

    /* ===== Sidebar Collapse / Mobile ===== */
    @media (max-width: 1200px) {
        #sidebar {
            width: 70px;
        }

        /* Only icons, hide text */
        #sidebar .sidebar-link span,
        #sidebar .sidebar-section-label,
        #sidebar .sidebar-footer .user-name,
        #sidebar .sidebar-footer .user-role,
        #sidebar .sidebar-brand .brand-text,
        #sidebar .sidebar-brand small {
            display: none;
        }

        #sidebar .sidebar-brand{
            padding: 1rem;
        }

        #sidebar .sidebar-footer {
            border: none;
        }

        /* Center icons */
        #sidebar .sidebar-link {
            justify-content: center;
            padding: 0.5rem 0;
        }
    }

    /* ===== Mobile Sidebar Offcanvas ===== */
    .offcanvas {
        background: var(--nova-sidebar-bg) !important;
        color: var(--nova-sidebar-text);
    }

    .offcanvas .sidebar-link {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        color: var(--nova-sidebar-text);
    }

    .offcanvas .sidebar-link.active {
        background: rgba(99, 102, 241, 0.15);
        color: #ffffff;
    }

    .offcanvas .sidebar-section-label {
        color: var(--nova-sidebar-muted);
        border-top: 1px solid var(--nova-border); 
        padding: 0.5rem 1rem;
    }

    .offcanvas .sidebar-footer {
        border-top: 1px solid var(--nova-border); 
        padding: 0.75rem 1rem;
        text-align: center;
    }

    /* Accessibility */
    a:focus-visible,
    button:focus-visible {
        outline: 2px solid var(--nova-sidebar-active);
        outline-offset: 2px;
    }
</style>



</head>

<body>
<div class="d-flex">

    <!-- Desktop Sidebar -->
    <aside id="sidebar" class="d-none d-lg-flex flex-column collapsed">

        <div class="sidebar-brand">
            <span class="brand-icon">R</span>
            <span class="brand-text mt-2">
                Rose Massage <br>
                <small class="text-muted">Admin Panel</small>
            </span>
        </div>

        @php
            $navItems = [
                ['label'=>'Dashboard','icon'=>'bi-speedometer2','route'=>'dashboard'],
                ['label'=>'Clients','icon'=>'bi-people','route'=>'clients'],
                ['label'=>'Services','icon'=>'bi-list-check','route'=>'services'],
                ['label'=>'Therapists','icon'=>'bi-heart-pulse','route'=>'therapists'],
            ];
        @endphp

        <nav class="flex-grow-1 py-2" aria-label="Main navigation">
            <div class="px-2">
                @foreach ($navItems as $item)
                    <a href="{{ route('admin.' . $item['route'] . '.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.' . $item['route'] . '.*') ? 'active' : '' }}">
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">SCHEDULES</div>
                <div class="px-2">
                    <a href="{{ route('admin.spa-weekly-schedules.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.spa-weekly-schedules.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-week"></i> 
                        <span>Weekly</span>
                    </a>
                </div>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">SETTINGS</div>
                <div class="px-2">
                    <a href="{{ route('admin.spa-settings.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.spa-settings.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i> 
                        <span>Spa</span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">{{ auth()->user()->role ?? 'User' }}</div>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-grow-1">

        <!-- Topbar -->
        <nav class="topbar border d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobileSidebar"
                        aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                @if($breadcrumbs ?? false)
                    @include('partials.shared.breadcrumb', ['crumbs' => $breadcrumbs])
                @endif
            </div>

            <div class="dropdown">
                <button class="btn btn-light rounded-circle text-bg-secondary" data-bs-toggle="dropdown">
                    <span class="fw-semibold">{{ strtoupper(substr(auth()->user()->name, 0,1)) }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li class="px-3 py-2 small text-muted">{{ auth()->user()->role ?? 'User' }}</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small" href="#">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger small">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <main class="p-4">
            <div class="page-header">
                <h1>@yield('page-heading')</h1>
                <p>@yield('page-heading-small')</p>
            </div>

            @yield('content')
        </main>
    </div>
</div>

<!-- Mobile Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
        <strong>Rose Massage</strong>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-0">
        <nav class="flex-grow-1 py-2">
            @foreach ($navItems as $item)
                <a href="{{ route('admin.' . $item['route'] . '.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.' . $item['route'] . '.*') ? 'active' : '' }}">
                    <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
                </a>
            @endforeach

            <div class="sidebar-section-label mt-3">SCHEDULES</div>
            <a href="{{ route('admin.spa-weekly-schedules.index') }}" class="sidebar-link">
                <i class="bi bi-calendar-week"></i> Weekly
            </a>

            <div class="sidebar-section-label mt-3">SETTINGS</div>
            <a href="{{ route('admin.spa-settings.index') }}" class="sidebar-link">
                <i class="bi bi-building"></i> Spa
            </a>
        </nav>

        <!-- Admin footer for mobile -->
        <div class="sidebar-footer mt-auto">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">{{ auth()->user()->role ?? 'User' }}</div>
        </div>


    </div>
</div>

@include('partials.shared.foot-scripts')
</body>
</html>
