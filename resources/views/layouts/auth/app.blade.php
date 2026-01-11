<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head-meta')
</head>


<body>

    {{-- Navbar --}}
    <nav id="top-navbar" class="navbar navbar-expand-lg shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guest.home.index') }}">Rose Massage</a>

            {{-- Toggler --}}
            <button class="navbar-toggler border-white rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <i class="bi bi-list fs-1"></i>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('guest.home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown">Register</button>
                            <ul class="dropdown-menu shadow border-0 rounded-3">
                                <h5 class="dropdown-header">Register as</h5>
                                <li><a class="dropdown-item" href="{{ route('register.client') }}">User</a></li>
                                <li><a class="dropdown-item" href="{{ route('register.therapist') }}">Therapist</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    {{-- Below Navbar / Main  --}}
    <div id="main" class="bg-light min-vh-100">

        <div class="container p-3">

            {{-- Breadcrumb --}}
            <nav id="breadcrumb" aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav> 

            {{-- Content --}}
            <div id="content" class="mt-4">
                @yield('content')
            </div>

        </div>

    </div>

    
    @include('partials.foot-script-shared')


</body>

</html>