@php
  $pembayaran = Auth::user()->pendaftar?->pembayaran;
@endphp

@if(Auth::user()->role === 'pendaftar')
 {{  dd($pembayaran) }}
<aside class="main-sidebar">
  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <!-- Dashboard -->
      <li class="active">
        <a href="{{ route('pendaftar.dashboard') }}">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- IDENTITAS SANTRI
           TAMPIL HANYA JIKA PEMBAYARAN SUKSES --}}
      @if($pembayaran && $pembayaran->status === 'diterima')
        <li>
          <a href="">
            <i class="fa fa-user"></i>
            <span>Identitas Santri</span>
          </a>
        </li>
        
        <!-- Upload Berkas (boleh tampil kapan saja / sesuaikan) -->
        <li>
          <a href="">
            <i class="fa fa-upload"></i>
            <span>Upload Berkas</span>
          </a>
        </li>
        @endif

    </ul>

  </section>
</aside>

@endif
