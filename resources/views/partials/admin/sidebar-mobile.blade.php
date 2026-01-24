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
            <a href="{{ route('admin.dashboard.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.bookings.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <i class="bi bi-calendar"></i> Bookings
            </a>

            <a href="{{ route('admin.clients.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Clients
            </a>

            <a href="{{ route('admin.services.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i> Services
            </a>

            <a href="{{ route('admin.therapists.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.therapists.*') ? 'active' : '' }}">
                <i class="bi bi-heart-pulse"></i> Therapists
            </a>

            <!-- Schedules Section -->
            <div class="sidebar-section mt-3">
                <div class="sidebar-section-label text-uppercase small text-white mb-1">Schedules</div>
                <a href="{{ route('admin.spa-weekly-schedules.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.spa-weekly-schedules.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i> Weekly
                </a>
            </div>

            <!-- Settings Section -->
            <div class="sidebar-section mt-3">
                <div class="sidebar-section-label text-uppercase small text-white mb-1">Settings</div>
                <a href="{{ route('admin.spa-settings.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.spa-settings.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Spa
                </a>
            </div>

        </nav>

        <!-- Footer -->
        <div class="sidebar-footer mt-auto text-center p-2">
            <div class="user-name text-white small fw-medium">{{ auth()->user()->name }}</div>
            <div class="user-role small text-muted">{{ auth()->user()->role ?? 'User' }}</div>
        </div>

    </div>
</div>
