@extends('layouts.app')

@section('judul', $settings['app_name'] ?? 'SIGAP PPDB')

@section('content')

    <div class="text-center mb-4">

        {{-- LOGO --}}
        <img src="{{ asset($settings['logo_app'] ?? 'assets/logo-sigap.svg') }}" class="img-fluid mb-3" style="max-height:90px"
            onerror="this.src='{{ asset('assets/logo-sigap.svg') }}'">

        {{-- JUDUL --}}
        <h5 class="fw-bold mb-1">
            {{ $settings['app_name'] ?? 'SIGAP PPDB' }}
            @if (!empty($settings['pondok_name']))
                <span class="text-muted fw-normal">
                    | {{ $settings['pondok_name'] }}
                </span>
            @endif
        </h5>

        {{-- SUB JUDUL --}}
        <small class="text-muted d-block mb-1">
            {{ $settings['system_name'] ?? 'Penerimaan Peserta Didik Baru' }}
        </small>

        {{-- TAHUN AJARAN --}}
        @if (!empty($settings['ppdb_academic_year']))
            <div class="fw-semibold fs-6">
                TAHUN AJARAN {{ $settings['ppdb_academic_year'] }}
            </div>
        @endif

    </div>


    @if (!empty($menus))
        <div class="ppdb-menu-list">

            @foreach ($menus as $i => $menu)
                {{-- ========== LINK ========== --}}
                @if (($menu['type'] ?? 'link') === 'link')
                    <a href="{{ url($menu['url'] ?? '#') }}" class="ppdb-menu-item">
                        <i class="fa {{ $menu['icon'] ?? 'fa-link' }}"></i>
                        <span>{{ $menu['title'] ?? 'Menu' }}</span>
                    </a>

                    {{-- ========== MODAL ========== --}}
                @else
                    <a href="javascript:void(0)" class="ppdb-menu-item" data-bs-toggle="modal"
                        data-bs-target="#menuModal{{ $i }}">
                        <i class="fa {{ $menu['icon'] ?? 'fa-info-circle' }}"></i>
                        <span>{{ $menu['title'] ?? 'Menu' }}</span>
                    </a>

                    {{-- MODAL --}}
                    <div class="modal fade" id="menuModal{{ $i }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="fa {{ $menu['icon'] ?? '' }}"></i>
                                        {{ $menu['title'] ?? 'Informasi' }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    {!! $menu['content'] ?? '<p class="text-muted">Konten belum tersedia</p>' !!}
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    @else
        <p class="text-center text-muted">Menu belum dikonfigurasi</p>
    @endif

@endsection
