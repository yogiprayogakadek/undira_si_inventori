<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <div class="navigation-left">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('dashboard.index') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashoard</span>
                </a>
                <div class="triangle"></div>
            </li>

            @can('admin')
                <li class="nav-item {{ Request::is('pengguna') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{ route('pengguna.index') }}">
                        <i class="nav-icon i-Administrator"></i>
                        <span class="nav-text">Pengguna</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan

            @can('admin')
                <li class="nav-item {{ Request::is('supplier') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{ route('supplier.index') }}">
                        <i class="nav-icon i-Students"></i>
                        <span class="nav-text">Supplier</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan


            <li class="nav-item {{ Request::is('produk') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('produk.index') }}">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Produk</span>
                </a>
                <div class="triangle"></div>
            </li>

            @can('admin')
                <li class="nav-item {{ Request::is('produk-masuk') ? 'active' : '' }}">
                    <a class="nav-item-hold" href="{{ route('produk-masuk.index') }}">
                        <i class="nav-icon i-Share"></i>
                        <span class="nav-text">Produk Masuk</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            @endcan

            <li class="nav-item {{ Request::is('produk-keluar') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('produk-keluar.index') }}">
                    <i class="nav-icon i-Rocket"></i>
                    <span class="nav-text">Produk Keluar</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item {{ Request::is('produk-request') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('produk-request.index') }}">
                    <i class="nav-icon i-Clock"></i>
                    <span class="nav-text">Produk Request</span>
                </a>
                <div class="triangle"></div>
            </li>
        </div>
    </div>
    <div class="sidebar-overlay"></div>
</div>
