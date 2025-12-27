<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head-meta')
</head>


<body>

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
                </ul>
            </div>
        </div>
    </nav>


    <div id="content" class="bg-light min-vh-100">
        <div class="container p-3">
            @yield('content')
        </div>
    </div>

    @include('partials.foot-script-shared')

</body>

</html>