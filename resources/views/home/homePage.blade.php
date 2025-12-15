@extends('layouts.app')

@section('title', $settings['app_name'] ?? 'SIGAP')
@section('page-title', 'Dashboard SIGAP')

@section('content')

<div class="header-logo text-center mb-3">
    <img
        src="{{ asset($settings['logo'] ?? 'assets/logo-sigap.svg') }}"
        alt="Logo Madrasah"
        class="logo-ppdb"
        onerror="this.src='{{ asset('assets/logo-sigap.svg') }}'"
    >
</div>

<h1 class="main-title text-center">
    {{ $settings['school_name'] ?? 'PPDB MADRASAH' }}
</h1>

@if(!empty($settings['school_subtitle']))
    <h2 class="subtitle text-center">
        {{ $settings['school_subtitle'] }}
    </h2>
@endif

@if(!empty($settings['academic_year']))
    <p class="year text-center">
        TAHUN AJARAN {{ $settings['academic_year'] }}
    </p>
@endif

@if(!empty($menus) && is_array($menus))
<div class="accordion ppdb-accordion mt-4" id="ppdbMenuAccordion">

    @foreach ($menus as $index => $menu)
        @php
            $headingId  = 'heading-'.$index;
            $collapseId = 'collapse-'.$index;
            $type       = $menu['type'] ?? 'accordion';
        @endphp

        {{-- MENU LINK --}}
        @if ($type === 'link')
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $headingId }}">
                    <a
                        href="{{ url($menu['url'] ?? '#') }}"
                        class="accordion-button collapsed text-decoration-none"
                    >
                        @if(!empty($menu['icon']))
                            <i class="fa {{ $menu['icon'] }} me-2"></i>
                        @endif
                        {{ $menu['title'] ?? 'Menu' }}
                    </a>
                </h2>
            </div>

        {{-- MENU ACCORDION --}}
        @else
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $headingId }}">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $collapseId }}"
                        aria-expanded="false"
                        aria-controls="{{ $collapseId }}"
                    >
                        @if(!empty($menu['icon']))
                            <i class="fa {{ $menu['icon'] }} me-2"></i>
                        @endif
                        {{ $menu['title'] ?? 'Menu' }}
                    </button>
                </h2>

                <div
                    id="{{ $collapseId }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="{{ $headingId }}"
                    data-bs-parent="#ppdbMenuAccordion"
                >
                    <div class="accordion-body">
                        {!! $menu['content'] ?? '<p class="text-muted">Konten belum tersedia.</p>' !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach

</div>
@else
    <p class="text-center text-muted mt-4">
        Menu belum dikonfigurasi.
    </p>
@endif

@endsection
