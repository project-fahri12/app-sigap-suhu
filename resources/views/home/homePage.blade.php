@extends('layouts.app')

@section('judul', setting('nama_sistem', 'SIGAP'))

@section('content')

    <div class="text-center mb-4">

        {{-- NAMA SISTEM & LEMBAGA --}}
        <h5 class="fw-bold mb-1">
            {{ setting('nama_sistem', 'SIGAP PPDB') }}
            @if (setting('nama_lembaga'))
                <span class="text-muted fw-normal">
                    | {{ setting('nama_lembaga') }}
                </span>
            @endif
        </h5>

        {{-- TAHUN AJARAN --}}
        <small class="text-muted d-block mb-1">
            Tahun Ajaran {{ setting('tahun_ajaran', '-') }}
        </small>

        {{-- GELOMBANG AKTIF --}}
        @if (! empty(setting('gelombang_aktif')))
            <div class="fw-semibold fs-6 text-success">
                PPDB {{ setting('status_ppdb') }} — {{ setting('gelombang_aktif', 'tidak ada gelombang aktif') }}
            </div>
        @endif

    </div>

    @php
        $menus = json_decode(setting('menu_ppdb', '[]'), true);
    @endphp

    @if (!empty($menus))
        <div class="ppdb-menu-list">

            @foreach ($menus as $i => $menu)
                {{-- LINK --}}
                @if (($menu['type'] ?? 'link') === 'link')
                    <a href="{{ url($menu['url'] ?? '#') }}" class="ppdb-menu-item">
                        <i class="fa {{ $menu['icon'] ?? 'fa-link' }}"></i>
                        <span>{{ $menu['title'] ?? 'Menu' }}</span>
                    </a>

                    {{-- MODAL / ACCORDION --}}
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
        <p class="text-center text-muted">Menu PPDB belum dikonfigurasi</p>
    @endif

@endsection
