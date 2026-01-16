<!-- Panel layout for Admin, Therapist -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.shared.head-meta')
    <!-- Panel's CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel.css') }}">
</head>

<body class="bg-light">

<div class="d-flex min-vh-100">

    <!-- Sidebar (Desktop) -->
    <aside id="sidebar"
           class="d-none d-lg-flex flex-column bg-primary text-white p-3"
           tabindex="-1"
           role="navigation">

        <!-- Brand -->
        <div class="fw-bold mb-4">Rose Massage</div>

        <!-- Internal User's Info -->
        <div class="mb-4 small">
            <div class="fw-semibold">{{ auth()->user()->name }}</div>
            <span class="badge bg-secondary mt-1">
                {{ auth()->user()->role ?? 'Internal User' }}
            </span>
        </div>



        {{-- Navigation --}}
        @if(auth()->user()->role === 'Admin')
            <ul class="nav nav-pills flex-column gap-1" role="menu">

                <li class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="#" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-calendar-check me-2"></i>Bookings
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.clients.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.clients.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-people me-2"></i>Clients
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.services.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.services.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-list-check me-2"></i>Services
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.therapists.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.therapists.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-heart-pulse me-2"></i>Therapists
                    </a>
                </li>

                <li class="mt-3 px-2 small text-uppercase opacity-75">Schedules</li>
                <li class="nav-item {{ request()->routeIs('admin.spa-weekly-schedules.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.spa-weekly-schedules.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-calendar-week me-2"></i>Weekly
                    </a>
                </li>

                <li class="mt-3 px-2 small text-uppercase opacity-75">Settings</li>
                <li class="nav-item {{ request()->routeIs('admin.spa-settings.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('admin.spa-settings.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-building me-2"></i>Spa
                    </a>
                </li>

            </ul>
        @elseif(auth()->user()->role === 'Therapist')
            <ul class="nav nav-pills flex-column gap-1" role="menu">

                <li class="nav-item {{ request()->routeIs('therapist.dashboard.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('therapist.dashboard.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('therapist.bookings.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="#" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-calendar-check me-2"></i>Bookings
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('therapist.services.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('therapist.services.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-list-check me-2"></i>Services
                    </a>
                </li>

                <li class="mt-3 px-2 small text-uppercase opacity-75">Spa's Schedules</li>
                <li class="nav-item {{ request()->routeIs('therapist.spa-weekly-schedules.*') ? 'bg-info rounded-3' : '' }}" role="none">
                    <a href="{{ route('therapist.spa-weekly-schedules.index') }}" class="nav-link text-white" role="menuitem">
                        <i class="bi bi-calendar-week me-2"></i>Weekly
                    </a>
                </li>
                

            </ul>
        @endif


    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1 d-flex flex-column">

        <!-- Topbar -->
        <nav class="navbar bg-white border-bottom px-3 d-flex align-items-center justify-content-between position-relative" role="navigation">

            <!-- Left: Breadcrumb -->
            <div class="d-flex align-items-center">
                @if($breadcrumbs ?? false)
                    @include('partials.shared.breadcrumb', ['crumbs' => $breadcrumbs])
                @endif
            </div>

            <!-- Center: Brand (Mobile) -->
            <div class="d-lg-none fw-bold text-center fst-italic position-absolute start-50 translate-middle-x">
                Rose Massage
            </div>

            <!-- Right: Profile Dropdown -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                @yield('page-actions')
                <div class="dropdown">
                    <button class="btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-label="User menu">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="rounded-circle" width="36" height="36" alt="User profile photo">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary text-white fw-semibold" style="width:36px;height:36px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item small" href="#">Profile</a></li>
                        <li><a class="dropdown-item small" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger small">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container-fluid p-4 flex-grow-1">
            <!-- Heading text -->
            <header class="mb-4">
                <h1 class="h5 fw-semibold mb-1">@yield('page-heading')</h1>
                <p class="text-muted small mb-0">@yield('page-heading-small')</p>
            </header>

            <section class="card shadow-sm">
                <div class="card-body">
                    @if(auth()->user()->role === 'Therapist' && is_null(auth()->user()->approved_at))
                        <div class="alert alert-warning mb-0">
                            Your account is pending approval. Some features may be restricted until approved by an administrator.
                        </div>
                    @else
                        @yield('content')
                    @endif  
                </div>
            </section>
        </main>

    </div>

</div>

@if(auth()->user()->role === 'Admin')
    <!-- Mobile Footer Menu -->
    <nav class="navbar d-lg-none navbar-light bg-white border-top fixed-bottom py-0">
        <ul class="nav nav-justified w-100">
            <li class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'bg-info' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}" class="nav-link text-center">
                    <i class="bi bi-speedometer2 fs-4 {{ request()->routeIs('admin.dashboard.*') ? 'text-white' : '' }}"></i>
                    <div class="small d-none d-sm-block {{ request()->routeIs('admin.dashboard.*') ? 'text-white' : '' }}">Dashboard</div>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'bg-info' : '' }}">
                <a href="#" class="nav-link text-center">
                    <i class="bi bi-calendar-check fs-4 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : '' }}"></i>
                    <div class="small d-none d-sm-block">Bookings</div>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.clients.*') ? 'bg-info' : '' }}">
                <a href="{{ route('admin.clients.index') }}" class="nav-link text-center">
                    <i class="bi bi-people fs-4 {{ request()->routeIs('admin.clients.*') ? 'text-white' : '' }}"></i>
                    <div class="small d-none d-sm-block">Clients</div>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.services.*') ? 'bg-info' : '' }}">
                <a href="{{ route('admin.services.index') }}" class="nav-link text-center">
                    <i class="bi bi-list-check fs-4 {{ request()->routeIs('admin.services.*') ? 'text-white' : '' }}"></i>
                    <div class="small d-none d-sm-block">Services</div>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.therapists.*') ? 'bg-info' : '' }}">
                <a href="{{ route('admin.therapists.index') }}" class="nav-link text-center">
                    <i class="bi bi-heart-pulse fs-4 {{ request()->routeIs('admin.therapists.*') ? 'text-white' : '' }}"></i>
                    <div class="small d-none d-sm-block">Therapists</div>
                </a>
            </li>
        </ul>
    </nav>
@endif

@include('partials.shared.foot-scripts')
@yield('foot-script-specific')

</body>
</html>
