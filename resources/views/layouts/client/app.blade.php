<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head-meta')
    <link rel="stylesheet" href="{{ asset('assets/css/style-guest-client.css') }}">
</head>


</style>

<body>

    {{-- Navbar --}}
    <nav id="top-navbar" class="navbar navbar-expand-lg navbar-primary bg-primary shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">Rose Massage</a>

            <!-- Toggler -->
            <button class="navbar-toggler border-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <i class="bi bi-list text-white fs-1"></i>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
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

                                    <ul class="dropdown-menu dropdown-menu-end shadow rounded-3">
                                        <li>
                                            <a class="dropdown-item" href="#">Profile</a>
                                        </li>
                                      
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="dropdown-item text-danger" onclick="return confirm('Confirm Logout?');">Logout</button>
                                            </form>
                                        </li>
                                    </ul>

                                </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div id="main" class="min-vh-100">
        @yield('content')
    </div>

    @include('partials.foot-script-shared')

</body>

</html>