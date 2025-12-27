<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head-meta')
</head>


</style>

<body class="bg-primary">

    <div class="container-fluid p-4">
        <div class="row">

            <div id="left-side-layout" class="col-lg-2">

                <aside id="left-sidebar" class="bg-light p-3 shadow-sm rounded-3">

                    {{-- User info --}}
                    <div class="mb-3 text-center">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>

                        <span class="badge bg-secondary mt-1">
                            {{ auth()->user()->role->name ?? 'Therapist' }}
                        </span>
                    </div>

                    <hr>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a href="{{ route('therapist.dashboard.index') }}" class="nav-link {{ request()->routeIs('therapist.dashboard.index') ? 'text-bg-secondary rounded-3' : 'text-dark' }}">
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
                            <a href="" class="nav-link text-dark">
                                <i class="bi bi-list-check me-2"></i>
                                Services
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

            <div id="right-side-layout" class="col-lg-10">

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
                                            <form method="POST" action="{{ route('logout.index') }}">
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

                <div class="container bg-white p-4 shadow-sm mt-4 min-vh-100 rounded-3">

                    <nav id="breadcrumb" aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>

                    <div id="page-heading">
                        <h4 class="fw-semibold mb-0">@yield('page-heading')</h4>
                        <p class="text-muted small mb-0">@yield('page-heading-small')</p>
                    </div>

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