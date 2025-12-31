<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head-meta')
</head>


</style>

<body class="bg-primary">

    <div class="container-fluid p-4">
        <div class="row">

            {{-- Left Side --}}
            <div id="left-side-layout" class="col-lg-2">

                {{-- Left Sidebar --}}
                <aside id="left-sidebar" class="bg-light p-3 shadow-sm rounded-3">

                    {{-- User info --}}
                    <div class="mb-3 text-center">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>

                        <span class="badge bg-secondary mt-1">
                            {{ auth()->user()->role->name ?? 'Admin' }}
                        </span>
                    </div>

                    <hr>

                    {{-- Side Nav Links --}}
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ request()->routeIs('admin.dashboard.index') ? 'text-bg-secondary rounded-3' : 'text-dark' }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-calendar-check me-2"></i>
                                Bookings
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.index') ? 'text-bg-secondary rounded-3' : 'text-dark' }}">
                                <i class="bi bi-people me-2"></i>
                                Clients
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.spa-profile.index') }}" class="nav-link {{ request()->routeIs('admin.spa-profile.index') ? 'text-bg-secondary rounded-3' : 'text-dark' }}">
                                <i class="bi bi-house-heart me-2"></i>
                                Spa Profile
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-person-badge me-2"></i>
                                Staffs
                            </a>
                        </li>

                        <li class="nav-item dropdown {{ request()->routeIs('admin.spa-weekly-schedules.index') ? 'bg-secondary rounded-3' : '' }}">
                            <button class="nav-link {{ request()->routeIs('admin.spa-weekly-schedules.index') ? 'text-white' : 'text-dark' }}" data-bs-toggle="dropdown">
                                <i class="bi bi-calendar-event me-2"></i>
                                Spa Schedules
                            </button>
                            <ul class="dropdown-menu rounded-3 shadow-sm">
                                <li>
                                    <a href="{{ route('admin.spa-weekly-schedules.index') }}" class="dropdown-item {{ request()->routeIs('admin.spa-weekly-schedules.index') ? 'text-bg-secondary' : 'text-dark' }}">
                                        <i class="bi bi-calendar-week me-2"></i>
                                        Weekly Schedules
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item">
                                        <i class="bi bi-calendar-minus me-2"></i>
                                        Datetime Unavailable
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-list-check me-2"></i>
                                Services
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.therapists.index') }}" class="nav-link {{ request()->routeIs('admin.therapists.index') ? 'text-bg-secondary rounded-3' : 'text-dark' }}">
                                <i class="bi bi-heart-pulse me-2"></i>
                                Therapists
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-credit-card me-2"></i>
                                Payments
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-journal-text me-2"></i>
                                System Logs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                    </ul>

                </aside>

            </div>

            {{-- Right Side --}}
            <div id="right-side-layout" class="col-lg-10">

                {{-- Top Right Navbar --}}
                <nav id="top-right-navbar" class="navbar navbar-expand-lg navbar-white bg-white shadow-sm px-4 py-3 rounded-3">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">Rose Massage</a>

                        <!-- Toggler -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Menu -->
                        <div class="collapse navbar-collapse" id="mainNavbar">

                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Home</a>
                                </li>
                                <!-- Profile Dropdown -->
                                <li class="nav-item dropdown ms-lg-3">
                                    <a class="nav-link p-0" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                        @php
                                            $user = auth()->user();
                                        @endphp

                                        @if($user && $user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                class="rounded-circle"
                                                width="40" height="40"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                                style="width:40px;height:40px;font-weight:600;">
                                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-person-circle me-2"></i>
                                                Profile
                                            </a>
                                        </li>

                                        <li class="mb-2">
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-gear me-2"></i>
                                                Settings
                                            </a>
                                        </li>

                                        <li><hr class="dropdown-divider"></li>

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="dropdown-item text-danger" onclick="return confirm('Confirm Logout?');"> 
                                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                                </button>
                                            </form>
                                        </li>

                                    </ul>

                                </li>

                            </ul>

                        </div>

                    </div>

                </nav>

                {{-- Below Top Right Navbar / Main --}}
                <div id="main" class="container bg-white p-4 shadow-sm mt-4 min-vh-100 rounded-3">

                    {{-- Breadcrumb --}}
                    <nav id="breadcrumb" aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>

                    {{-- Page Heading --}}
                    <div id="page-heading">
                        <h4 class="fw-semibold mb-0">@yield('page-heading')</h4>
                        <p class="text-muted small mb-0">@yield('page-heading-small')</p>
                    </div>

                    {{-- Content --}}
                    <div id="content" class="mt-4">
                        @yield('content')
                    </div>

                </div>

            </div>

        </div>
    </div>

    @include('partials.foot-script-shared')

    <!-- Specific JS Scripts -->
    @yield('foot-script-specific')

</body>

</html>