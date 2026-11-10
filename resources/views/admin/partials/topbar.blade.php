<header class="topbar">
    <button class="menu-toggle"><i class="bi bi-list"></i></button>

    <div class="topbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search orders, products, customers…">
    </div>

    <div class="topbar-actions">
        <a href="#" class="icon-btn" title="Notifications">
            <i class="bi bi-bell"></i>
            <span class="dot"></span>
        </a>
        <a href="#" class="icon-btn" title="View store">
            <i class="bi bi-box-arrow-up-right"></i>
        </a>
        <div class="admin-user">
            <div class="avatar">
                {{ strtoupper(collect(explode(' ', auth()->user()->name))->map(fn($word) => substr($word, 0, 1))->take(2)->join('')) }}
            </div>
            <div>
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
            <i class="bi bi-chevron-down" style="color:var(--ink-soft);font-size:12px;margin-left:2px"></i>
        </div>
    </div>
</header>