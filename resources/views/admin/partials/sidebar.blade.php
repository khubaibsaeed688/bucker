<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="mark">B.</div>
        <div>
            <div class="name">Bucker Admin</div>
            <div class="sub">Store control panel</div>
        </div>
    </div>

    <div class="nav-section-label">General</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"><i class="bi bi-graph-up"></i> Reports</a></li>
    </ul>

    <div class="nav-section-label">Catalog</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i> Products </a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Categories</a></li>
        <li><a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"><i class="bi bi-star"></i> Reviews </a></li>
    </ul>

    <div class="nav-section-label">Sales</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"><i class="bi bi-bag-check"></i> Orders </a></li>
        <li><a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Customers</a></li>
        <li><a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}"><i class="bi bi-ticket-perforated"></i> Coupons</a></li>
    </ul>

    <div class="nav-section-label">Content</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"><i class="bi bi-file-text"></i> Blog Posts</a></li>
        <li><a href="{{ route('admin.blog.categories') }}" class="nav-link {{ request()->routeIs('admin.blog.categories') ? 'active' : '' }}"><i class="bi bi-folder2-open"></i> Blog Categories</a></li>
        <li><a href="{{ route('admin.banners.index') }}" class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"><i class="bi bi-image"></i> Banners &amp; Sliders</a></li>
    </ul>

    <div class="nav-section-label">Team &amp; Access</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="bi bi-person-badge"></i> Admin Users</a></li>
        <li><a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"><i class="bi bi-shield-lock"></i> Roles &amp; Permissions</a></li>
    </ul>

    <div class="nav-section-label">System</div>
    <ul class="nav-list">
        <li><a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="bi bi-gear"></i> Settings</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link logout-btn"><i class="bi bi-box-arrow-right"></i> Log out </button>
            </form>
        </li>
    </ul>
</aside>