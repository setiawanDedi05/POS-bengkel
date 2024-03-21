<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Pada Jaya Motor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PDJM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('home') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-user"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('user.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-cube"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('product.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('product.index') }}">All Product</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-cube"></i><span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('order.index') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('order.index') }}">All Order</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
