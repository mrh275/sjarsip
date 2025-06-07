<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-center align-items-center">
                <div class="logo">
                    <a href="{{ url('admin/dashboard') }}" class="fs-1 fw-bold">
                        SJ Arsip
                    </a>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ $sidebar == 'dashboard' ? 'active' : '' }} ">
                    <a href="{{ url('admin/dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ $sidebar == 'tambah-arsip' || $sidebar == 'data-arsip' ? 'active' : '' }}">
                    <a href="javascript:void(0)" class='sidebar-link'>
                        <i class="fas fa-archive"></i>
                        <span>Data Arsip</span>
                    </a>
                    <ul class="submenu {{ $sidebar == 'tambah-arsip' ? 'submenu-open' : '' }}">
                        <li class="submenu-item {{ $sidebar == 'tambah-arsip' ? 'active' : '' }}">
                            <a href="{{ url('admin/tambah-surat') }}">Tambah Arsip Surat</a>
                        </li>
                        <li class="submenu-item {{ $sidebar == 'data-arsip' ? 'active' : '' }}">
                            <a href="{{ url('admin/data-arsip') }}">Data Arsip</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ $sidebar == 'laporan' ? 'active' : '' }}">
                    <a href="{{ url('admin/laporan') }}" class="sidebar-link">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
