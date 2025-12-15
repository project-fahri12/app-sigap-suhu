@if(Auth::user()->role === 'pendaftar')

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
      @if($verifikasi && $verifikasi->verifikasi_pembayaran === 'valid')

        <li class="{{ request()->routeIs('pendaftar.identitas*') ? 'active' : '' }}">
          <a href="">
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
