<!-- Mobile Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
        <strong>Rose Massage</strong>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-0">

        <!-- Navigation -->
        <nav class="flex-grow-1 py-2 px-2">

            <!-- Main Links -->
            <a href="{{ route('therapist.dashboard.index') }}" 
               class="sidebar-link {{ request()->routeIs('therapist.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

        </nav>

        <!-- Footer -->
        <div class="sidebar-footer mt-auto text-center p-2">
            <div class="user-name text-white small fw-medium">{{ auth()->user()->name }}</div>
            <div class="user-role small text-muted">{{ auth()->user()->role ?? 'User' }}</div>
        </div>

    </div>
</div>
