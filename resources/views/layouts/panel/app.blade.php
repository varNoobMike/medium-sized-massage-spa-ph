<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.shared.head-meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel.css') }}">
</head>

<body class="d-flex">
        
    <!-- Sidebar -->
    @include('partials.' . auth()->user()->role . '.sidebar')
    
    <!-- Main -->
    <div class="flex-grow-1 d-flex flex-column">
        <!-- Topbar Desktop -->
        <nav class="topbar sticky-top border d-flex align-items-center justify-content-between px-4 bg-white">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    <i class="bi bi-list"></i>
                </button>

                @if($breadcrumbs ?? false)
                    @include('partials.shared.breadcrumb', ['crumbs' => $breadcrumbs])
                @endif
            </div>

            <div class="dropdown">
                <button class="btn btn-light rounded-circle text-bg-secondary" data-bs-toggle="dropdown">
                    <span class="fw-semibold">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
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
        <main class="p-4 flex-grow-1" style="max-width:1400px;">
            <div class="page-header mb-3">
                <h1 class="h5 fw-semibold">@yield('page-heading')</h1>
                <p class="small text-muted mb-0">@yield('page-heading-small')</p>
            </div>
            @if((auth()->user()->role === 'Therapist') &&
               (!auth()->user()->approved_at))
               <div class="card border-warning bg-warning-subtle text-dark mt-4 mx-auto text-center" 
                        style="max-width: 500px;">
                    <div class="card-body">
                        <i class="bi bi-exclamation-triangle-fill fs-1 text-warning mb-3"></i>
                        <h4 class="card-title mb-2">Account Pending Approval</h4>
                        <p class="card-text mb-0">
                            Your account has not yet been approved by the administrator. 
                            You will be able to access the system once your account is approved.
                        </p>
                    </div>
                </div>
            @else
                @yield('content')
            @endif
        </main>
    </div>

    <!-- Mobile Sidebar -->
    @include('partials.' . auth()->user()->role . '.sidebar-mobile')

    
@include('partials.shared.foot-scripts')
</body>
</html>
