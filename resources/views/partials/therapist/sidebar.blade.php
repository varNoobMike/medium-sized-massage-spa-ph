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
            <a href="{{ route('therapist.dashboard.index') }}" 
               class="sidebar-link {{ request()->routeIs('therapist.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </div>
 
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer mt-auto px-2">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-role">{{ auth()->user()->role ?? 'User' }}</div>
    </div>

</aside>
