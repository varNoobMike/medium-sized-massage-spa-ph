<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.shared.head-meta')
</head>

<body>

    {{-- Navbar --}}
    <nav id="top-navbar" class="navbar navbar-expand-lg navbar-primary bg-primary shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ route('guest.home.index') }}">Rose Massage</a>

            {{-- Toggler --}}
            <button class="navbar-toggler border-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <i class="bi bi-list text-white fs-1"></i>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="{{ route('guest.home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="nav-link text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">Register</button>
                            <ul class="dropdown-menu shadow border-0 rounded-3">
                                <h5 class="dropdown-header">Register as</h5>
                                <li><a class="dropdown-item" href="{{ route('register.client') }}">User</a></li>
                                <li><a class="dropdown-item" href="#">Therapist</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Below Navbar / Main --}}
    <div id="main" class="min-vh-100">
        @yield('content')
    </div>

    @include('partials.shared.foot-scripts')
</body>

</html>