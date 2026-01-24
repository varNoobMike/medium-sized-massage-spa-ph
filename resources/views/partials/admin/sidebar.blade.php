<!-- Sidebar -->
<aside id="sidebar" class="d-none d-lg-flex flex-column">

    <!-- Brand -->
    <div class="sidebar-brand">
        <span class="brand-icon">R</span>
        <span class="brand-text mt-2">Rose Massage</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-grow-1 py-2">
        <div class="px-2">
            <a href="{{ route('admin.dashboard.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <i class="bi bi-calendar"></i>
                <span>Bookings</span>
            </a>

            <a href="{{ route('admin.clients.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Clients</span>
            </a>

            <a href="{{ route('admin.services.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-list-check"></i>
                <span>Services</span>
            </a>

            <a href="{{ route('admin.therapists.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.therapists.*') ? 'active' : '' }}">
                <i class="bi bi-heart-pulse"></i>
                <span>Therapists</span>
            </a>
        </div>

        <!-- Schedules Section -->
        <div class="sidebar-section">
            <div class="sidebar-section-label">SCHEDULES</div>
            <div class="px-2">
                <a href="{{ route('admin.spa-weekly-schedules.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.spa-weekly-schedules.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i>
                    <span>Weekly</span>
                </a>
            </div>
        </div>

        <!-- Settings Section -->
        <div class="sidebar-section">
            <div class="sidebar-section-label">SETTINGS</div>
            <div class="px-2">
                <a href="{{ route('admin.spa-settings.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.spa-settings.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Spa</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer mt-auto px-2">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-role">{{ auth()->user()->role ?? 'User' }}</div>
    </div>

</aside>
