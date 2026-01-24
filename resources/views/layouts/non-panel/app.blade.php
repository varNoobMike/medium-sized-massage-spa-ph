{{-- Non-panel layout for Client, Guest, Auth --}}
<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Head Meta / SEO / Styles --}}
    @include('partials.shared.head-meta')
</head>

<style>
    #hero {
        height: 70vh;
    }
</style>

<style>
    
</style>

<body class="bg-light">

    {{-- Navbar --}}
    <nav id="top-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3" aria-label="Main Navigation">
        <div class="container">
            {{-- Brand --}}
            <a class="navbar-brand text-white" href="{{ url('/') }}">Rose Massage</a>

            {{-- Toggler --}}
            <button class="navbar-toggler border-white rounded-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list text-white fs-1"></i>
            </button>

            {{-- Navbar Links --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
                    </li>

                    @auth
                        {{-- Bookings --}}
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('client.bookings.index') }}">Bookings</a>
                        </li>

                        {{-- Services --}}
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Services</a>
                        </li>
                    @endauth

                    {{-- Contact --}}
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>

                    {{-- Register Dropdown for Guests --}}
                    @guest
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle" href="#" id="registerDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Register
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow rounded-3" aria-labelledby="registerDropdown">
                                {{-- Dropdown Header --}}
                                <li>
                                    <h6 class="dropdown-header">Register As</h6>
                                </li>
                                {{-- Divider --}}
                                <li><hr class="dropdown-divider"></li>
                                {{-- Register Options --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('register.client') }}">Client</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('register.therapist') }}">Therapist</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Login --}}
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    {{-- Profile Dropdown for Authenticated Users --}}
                    @auth
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link p-0 d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu">

                                @php $user = auth()->user(); @endphp

                                @if($user && $user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}"
                                        class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                                        style="width:40px;height:40px;font-weight:600;">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow rounded-3" aria-label="User menu options">
                                <li>
                                    <a class="dropdown-item" href="#">Profile</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"
                                            onclick="return confirm('Confirm Logout?');">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main id="main" class="min-vh-100" role="main">
        <div class="container py-3">
            {{-- Breadcrumb --}}
            @if($breadcrumbs ?? false)
                @include('partials.shared.breadcrumb', ['crumbs' => $breadcrumbs])
            @endif
            {{-- Page Content --}}
            @yield('content')
        </div>
    </main>

    {{-- Footer Scripts --}}
    @include('partials.shared.foot-scripts')

</body>

</html>
