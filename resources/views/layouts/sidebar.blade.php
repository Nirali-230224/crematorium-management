<style>
    .app-sidebar {
        width: 250px;
        height: 100vh;
        background: linear-gradient(180deg, #1e293b, #0f172a);
        color: #fff;
        position: fixed;
    }

    .sidebar-logo {
        padding: 20px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-menu {
        list-style: none;
        padding: 10px;
        margin: 0;
    }

    .menu-title {
        font-size: 12px;
        text-transform: uppercase;
        color: #94a3b8;
        margin: 15px 10px 5px;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        color: #cbd5f5;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .menu-item a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .menu-item.active a {
        background: linear-gradient(45deg, #3b82f6, #6366f1);
        color: #fff;
    }

    .menu-item i {
        font-size: 18px;
    }

    /* Submenu */
    .has-sub .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        padding-left: 15px;
    }

    .has-sub.open .submenu {
        max-height: 200px;
    }

    .submenu li a {
        font-size: 14px;
        padding: 8px 10px;
    }

    .arrow {
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .has-sub.open .arrow {
        transform: rotate(180deg);
    }
</style>
<aside class="app-sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <h4>🔥 Crematorium</h4>
    </div>

    <!-- Menu -->
    <ul class="sidebar-menu">

        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="bi bi-person"></i>
                <span>User manage</span>
            </a>
        </li>
        <!-- Section -->
        <li class="menu-title">Management</li>

        <li class="menu-item {{ request()->is('deceased*') ? 'active' : '' }}">
            <a href="{{ route('deceased.index') }}">
                <i class="bi bi-person"></i>
                <span>Deceased</span>
            </a>
        </li>

        <li class="menu-item {{ request()->is('donation*') ? 'active' : '' }}">
            <a href="{{ route('donation.index') }}">
                <i class="bi bi-cash"></i>
                <span>Donations</span>
            </a>
        </li>
        @if(auth()->user()->role == 'admin')

        <!-- Reports -->
        <li class="menu-title">Reports</li>

        <li class="menu-item has-sub {{ request()->is('report*') ? 'open' : '' }}">

            <a href="#" class="toggle-submenu">
                <i class="bi bi-file-earmark-text"></i>
                <span>Reports</span>
                <i class="bi bi-chevron-down arrow"></i>
            </a>

            <ul class="submenu">
                <li class="{{ request()->is('deceased-report') ? 'active' : '' }}">
                    <a href="{{ route('deceased.report') }}">Deceased Report</a>
                </li>

                <li class="{{ request()->is('donation-report') ? 'active' : '' }}">
                    <a href="{{ route('donation.report') }}">Donation Report</a>
                </li>
            </ul>
        </li>
        @endif
    </ul>

</aside>
<script>
    document.querySelectorAll('.toggle-submenu').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('open');
        });
    });
</script>