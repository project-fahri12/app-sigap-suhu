{{-- ========== sIDEBAR PNDFTR ========== --}}

@if (Auth::user()->role === 'pendaftar')
    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>

                {{-- DASHBOARD --}}
                <li class="{{ request()->routeIs('pendaftar.dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- JIKA PEMBAYARAN SUDAH VALID --}}
                @if ($verifikasi && $verifikasi->verifikasi_pembayaran === 'valid' || 'invalid')
                    <li class="{{ request()->routeIs('pendaftar.identitas.santri') ? 'active' : '' }}">
                        <a href="{{ route('pendaftar.identitas.santri') }}">
                            <i class="fa fa-user"></i>
                            <span>Identitas Santri</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('pendaftar.upload-berkas*') ? 'active' : '' }}">
                        <a href="{{ route('pendaftar.upload-berkas.index') }}">
                            <i class="fa fa-upload"></i>
                            <span>Upload Berkas</span>
                        </a>
                    </li>
                @endif

            </ul>

        </section>
    </aside>
@endif

{{-- ======= ADMIN ====== --}}

@auth
    @if (Auth::user()->role === 'admin')
        <aside class="main-sidebar">
            <section class="sidebar">

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">ADMIN PANEL</li>

                    {{-- DASHBOARD --}}
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    {{-- DATA MASTER --}}
                    <li
                        class="treeview {{ request()->routeIs('admin.tahun-ajaran.*', 'admin.gelombang.*', 'admin.unit.*', 'admin.sekolah-pilihan.*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-database"></i>
                            <span>Data Master</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>

                        <ul class="treeview-menu">

                            <li class="{{ request()->routeIs('admin.tahun-ajaran.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.tahun-ajaran.index') }}">
                                    <i class="fa fa-circle-o"></i> Tahun Ajaran
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.gelombang.index') }}">
                                    <i class="fa fa-circle-o"></i> Gelombang
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.unit.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.unit.index') }}">
                                    <i class="fa fa-circle-o"></i> Unit
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.sekolah-pilihan.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.sekolah-pilihan.index') }}">
                                    <i class="fa fa-circle-o"></i> Sekolah Pilihan
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- DATA PENDAFTAR --}}
                    <li class="{{ request()->routeIs('admin.data-pendaftar.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-pendaftar.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Data Pendaftar</span>
                        </a>
                    </li>

                    {{-- VERIFIKASI (GABUNG) --}}
                    <li class="{{ request()->routeIs('admin.verifikasi-pendaftar.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.verifikasi-pendaftar.index') }}">
                            <i class="fa fa-check-square-o"></i>
                            <span>Verifikasi</span>
                        </a>
                    </li>


                    {{-- LAPORAN --}}
                    <li>
                        <a href="#">
                            <i class="fa fa-file-pdf-o"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                    {{-- SETTING WEB --}}
                    <li class="{{ request()->routeIs('admin.setting-web.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.setting-web.index') }}">
                            <i class="fa fa-globe"></i>
                            <span>Setting Web</span>
                        </a>
                    </li>

                </ul>

            </section>
        </aside>
    @endif
@endauth
