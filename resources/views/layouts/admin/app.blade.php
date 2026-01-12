<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.shared.head-meta')
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>

<body>

<div class="d-flex min-vh-100">

    {{-- ================= Sidebar ================= --}}
    <aside
        id="adminSidebar"
        class="admin-sidebar p-3 offcanvas-lg offcanvas-start"
        tabindex="-1"
        role="navigation"
        aria-label="Primary sidebar"
    >

        {{-- Mobile Header --}}
        <div class="d-lg-none d-flex justify-content-between align-items-center mb-3">
            <span class="text-white fw-semibold">Rose Massage</span>
            <button
                class="btn btn-sm btn-outline-light"
                data-bs-dismiss="offcanvas"
                data-bs-target="#adminSidebar"
                aria-label="Close sidebar"
            >
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Brand --}}
        <div class="brand text-white mb-4 d-none d-lg-block">
            Rose Massage
        </div>

        {{-- User --}}
        <div class="mb-4 small text-white">
            <div class="fw-semibold">{{ auth()->user()->name }}</div>
            <span class="badge bg-secondary mt-1">
                {{ auth()->user()->role->name ?? 'Admin' }}
            </span>
        </div>

        {{-- Navigation --}}
        <ul class="nav flex-column gap-1">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard.index') }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"
                   href="{{ route('admin.clients.index') }}">
                    <i class="bi bi-people"></i>
                    Clients
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                   href="{{ route('admin.services.index') }}">
                    <i class="bi bi-list-check"></i>
                    Services
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.therapists.*') ? 'active' : '' }}"
                   href="{{ route('admin.therapists.index') }}">
                    <i class="bi bi-heart-pulse"></i>
                    Therapists
                </a>
            </li>

            <li class="sidebar-section px-2">SCHEDULES</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.spa-weekly-schedules.*') ? 'active' : '' }}"
                   href="{{ route('admin.spa-weekly-schedules.index') }}">
                    <i class="bi bi-calendar-week"></i>
                    Weekly
                </a>
            </li>

            <li class="sidebar-section px-2">SETTINGS</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.spa-profile.*') ? 'active' : '' }}"
                   href="{{ route('admin.spa-profile.index') }}">
                    <i class="bi bi-building"></i>
                    Spa Profile
                </a>
            </li>

        </ul>
    </aside>

    {{-- ================= Main ================= --}}
    <div class="flex-grow-1">

        {{-- Topbar --}}
        <nav
            class="admin-topbar d-flex align-items-center justify-content-between px-4"
            role="navigation"
            aria-label="Top navigation"
        >

            {{-- Left --}}
            <div class="d-flex align-items-center gap-2">

                <button
                    class="btn btn-sm btn-outline-secondary d-lg-none"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#adminSidebar"
                    aria-label="Toggle sidebar"
                >
                    <i class="bi bi-list"></i>
                </button>

                {{-- Breadcrumbs --}}
                <div id="breadcrumbs">
                    @include('partials.shared.breadcrumb', ['crumbs' => $breadcrumbs ?? []])
                </div>

            </div>

            {{-- Right --}}
            <div class="d-flex align-items-center gap-3">

                @yield('page-actions')

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown"
                       class="d-flex align-items-center text-decoration-none"
                       aria-label="User menu">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                 class="rounded-circle avatar">
                        @else
                            <div class="avatar bg-secondary text-white">
                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                            </div>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>

        </nav>

        {{-- Content --}}
        <main class="admin-content" role="main" aria-labelledby="page-title">

            <div class="content-canvas">

                {{-- Page Header --}}
                <header class="mb-4">
                    <h5 id="page-title" class="fw-semibold mb-1">
                        @yield('page-heading')
                    </h5>
                    <p class="text-muted small mb-0">
                        @yield('page-heading-small')
                    </p>
                </header>

                {{-- Page Body --}}
                <section class="page-card" aria-label="Page content">
                    @yield('content')
                </section>

            </div>

        </main>

    </div>
</div>

@include('partials.shared.foot-scripts')
@yield('foot-script-specific')

</body>
</html>
