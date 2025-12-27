<style>
    /* CUSTOM SIDEBAR MODERN */
    .main-sidebar {
        background-color: #222d32 !important;
        /* Warna dasar sidebar */
    }

    /* Styling Menu Item */
    .sidebar-menu>li {
        margin: 4px 12px;
        /* Memberi ruang agar terlihat melayang/rounded */
        transition: all 0.3s;
    }

    .sidebar-menu>li>a {
        border-radius: 8px !important;
        /* Membuat sudut membulat */
        color: #b8c7ce !important;
        padding: 12px 15px !important;
        border-left: none !important;
        /* Menghilangkan border kiri default AdminLTE */
    }

    /* ACTIVE STATE: HIJAU & TEXT PUTIH */
    .sidebar-menu>li.active>a,
    .sidebar-menu>li.menu-open>a {
        background-color: #00a65a !important;
        /* Hijau */
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(0, 166, 90, 0.3);
        /* Shadow halus */
    }

    .sidebar-menu>li.active>a i {
        color: #ffffff !important;
    }

    /* HOVER STATE */
    .sidebar-menu>li:hover:not(.active)>a {
        background-color: rgba(255, 255, 255, 0.05) !important;
        color: #ffffff !important;
        border-radius: 8px !important;
    }

    /* Sub-menu (Treeview) Styling */
    .sidebar-menu .treeview-menu {
        background: transparent !important;
        padding-left: 10px !important;
    }

    .sidebar-menu .treeview-menu>li>a {
        border-radius: 8px !important;
        margin: 2px 0;
    }

    .sidebar-menu .treeview-menu>li.active>a {
        color: #00a65a !important;
        /* Text hijau untuk sub-menu aktif */
        font-weight: bold;
        background: rgba(0, 166, 90, 0.1) !important;
    }

    /* Header Styling */
    .sidebar-menu>li.header {
        background: transparent !important;
        color: #4b646f !important;
        font-size: 10px;
        letter-spacing: 1.5px;
        padding: 20px 15px 10px 15px !important;
    }
</style>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

            {{-- ========== SIDEBAR PENDAFTAR ========== --}}
            @if (Auth::user()->role === 'pendaftar')
                <li class="header">PENDAFTAR MENU</li>

                <li class="{{ request()->routeIs('pendaftar.dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.dashboard') }}" class="btn-loading">
                        <i class="fa fa-th-large"></i> <span>Dashboard</span>
                    </a>
                </li>

                @if ($verifikasi && in_array($verifikasi->verifikasi_pembayaran, ['valid', 'invalid']))
                    <li class="{{ request()->routeIs('pendaftar.identitas.santri') ? 'active' : '' }}">
                        <a href="{{ route('pendaftar.identitas.santri') }}" class="btn-loading">
                            <i class="fa fa-user-circle"></i> <span>Identitas Santri</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('pendaftar.upload-berkas*') ? 'active' : '' }}">
                        <a href="{{ route('pendaftar.upload-berkas.index') }}" class="btn-loading">
                            <i class="fa fa-cloud-upload"></i> <span>Upload Berkas</span>
                        </a>
                    </li>
                @endif
            @endif

            {{-- ========== SIDEBAR ADMIN ========== --}}
            @if (Auth::user()->role === 'admin')
                <li class="header">ADMINISTRATOR</li>

                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="btn-loading">
                        <i class="fa fa-line-chart"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="treeview {{ request()->routeIs('admin.tahun-ajaran.*', 'admin.gelombang.*', 'admin.unit.*', 'admin.sekolah-pilihan.*') ? 'active menu-open' : '' }}">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ request()->routeIs('admin.tahun-ajaran.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.tahun-ajaran.index') }}" class="btn-loading"><i
                                    class="fa fa-circle-o"></i> Tahun Ajaran</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.gelombang.index') }}" class="btn-loading"><i
                                    class="fa fa-circle-o"></i> Gelombang</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.unit.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.unit.index') }}" class="btn-loading"><i
                                    class="fa fa-circle-o"></i> Unit</a>
                        </li>
                        <li class="{{ request()->routeIs('admin.sekolah-pilihan.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.sekolah-pilihan.index') }}" class="btn-loading"><i
                                    class="fa fa-circle-o"></i> Sekolah Pilihan</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('admin.data-akun.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.data-akun.index') }}" class="btn-loading">
                        <i class="fa fa-users"></i> <span>Data Akun</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.kontak-pendaftar') ? 'active' : '' }}">
                    <a href="{{ route('admin.kontak-pendaftar') }}" class="btn-loading">
                        <i class="fa fa-users"></i> <span>Kontak Pendaftar</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.data-pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.data-pendaftar.index') }}" class="btn-loading">
                        <i class="fa fa-users"></i> <span>Data Pendaftar</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.verifikasi-pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.verifikasi-pendaftar.index') }}" class="btn-loading">
                        <i class="fa fa-check-circle"></i> <span>Verifikasi</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.laporan.index') }}" class="btn-loading">
                        <i class="fa fa-print"></i> <span>Laporan PPDB</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.setting-web.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting-web.index') }}" class="btn-loading">
                        <i class="fa fa-gears"></i> <span>Setting Web</span>
                    </a>
                </li>
            @endif

            {{-- ========== SIDEBAR PETUGAS ========== --}}
            @if (Auth::user()->role === 'petugas')
                <li class="header">PETUGAS PENDAFTARAN</li>

                <li class="{{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('petugas.dashboard') }}" class="btn-loading">
                        <i class="fa fa-line-chart"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('petugas.data-pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('petugas.data-pendaftar.index') }}" class="btn-loading">
                        <i class="fa fa-users"></i> <span>Data Pendaftar</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('petugas.verifikasi-pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('petugas.verifikasi-pendaftar.index') }}" class="btn-loading">
                        <i class="fa fa-check-circle"></i> <span>Verifikasi</span>
                    </a>
                </li>
{{-- 
                <li class="{{ request()->routeIs('petugas.laporan.index') ? 'active' : '' }}">
                    <a href="{{ route('petugas.laporan.index') }}" class="btn-loading">
                        <i class="fa fa-print"></i> <span>Laporan PPDB</span>
                    </a>
                </li> --}}
            @endif

        </ul>
    </section>
</aside>
