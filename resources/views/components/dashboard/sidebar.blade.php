@php
    $roles = Auth::user()->role;
@endphp

{{-- ============== PENDAFTAR ============== --}}
@if ($roles = 'pendaftar')
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16 3V9L12 7L8 9V3" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M9 21V15H15V21" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div>
                <h2>Portal Pendaftar</h2>
                <div style="font-size: 0.75rem; opacity: 0.8; margin-top: 2px;">Status Pendaftaran</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <h3>Proses Pendaftaran</h3>
                <ul class="nav-links">

                    <li>
                        <a href="{{ route('pendaftar.dashboard') }}"
                            class="{{ request()->routeIs('pendaftar.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <span>Dashboard Utama</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pendaftar.pembayaran.index') }}" class="{{ request()->routeIs('pendaftar.pembayaran*') ? 'active' : '' }}">
                            <i class="fas fa-wallet nav-icon"></i>
                            <span>Pembayaran</span>
                        </a>
                    </li>

                    {{-- Hanya tampilkan jika satatus pembayaran nya done --}}
                    <li>
                        <a href="" class="{{ request()->routeIs('pendaftar.lengkapi_data') ? 'active' : '' }}">
                            <i class="fas fa-file-upload nav-icon"></i>
                            <span>Data & Berkas</span>
                        </a>
                    </li>
                    {{--  --}}


                    <li>
                        <a href="" class="{{ request()->routeIs('pendaftar.status') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-check nav-icon"></i>
                            <span>Status Verifikasi</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </aside>
@endif
{{-- ============== END PENDAFTAR ============== --}}




{{-- ============== ADMIN ============== --}}
@if ($roles = 'admin')
@endif
{{-- ============== END ADMIN ============== --}}



{{-- ============== PETUGAS ============== --}}
@if ($roles = 'petugas')
@endif
{{-- ============== END PETUGAS ============== --}}



{{-- ============== PENGASUH ============== --}}
@if ($roles = 'pengasuh')
@endif
{{-- ============== END PENGASUH ============== --}}
