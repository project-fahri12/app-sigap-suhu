@extends('layouts.app')

@section('title', $settings['app_name'] ?? 'SIGAP')
@section('page-title', 'Dashboard SIGAP')

@section('content')

<div class="header-logo text-center mb-3">
    <img src="{{ asset($settings['logo'] ?? 'assets/logo-sigap.svg') }}"
         alt="Logo Madrasah"
         class="logo-ppdb">
</div>

<h1 class="main-title text-center">
    {{ $settings['school_name'] ?? 'PPDB MADRASAH' }}
</h1>

<h2 class="subtitle text-center">
    {{ $settings['school_subtitle'] ?? '' }}
</h2>

<p class="year text-center">
    TAHUN AJARAN {{ $settings['academic_year'] ?? '' }}
</p>

<div class="accordion ppdb-accordion mt-4" id="ppdbMenuAccordion">

    @foreach ($menus as $index => $menu)
        @php
            $headingId = 'heading'.$index;
            $collapseId = 'collapse'.$index;
        @endphp

        {{-- MENU LINK (FORMULIR) --}}
        @if (($menu['type'] ?? '') === 'link')
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $headingId }}">
                    <a href="{{ url($menu['url']) }}"
                       class="accordion-button collapsed text-decoration-none">
                        <i class="fa {{ $menu['icon'] }}"></i>
                        {{ $menu['title'] }}
                    </a>
                </h2>
            </div>

        {{-- MENU ACCORDION --}}
        @else
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $headingId }}">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#{{ $collapseId }}">
                        <i class="fa {{ $menu['icon'] }}"></i>
                        {{ $menu['title'] }}
                    </button>
                </h2>

                <div id="{{ $collapseId }}"
                     class="accordion-collapse collapse"
                     data-bs-parent="#ppdbMenuAccordion">
                    <div class="accordion-body">
                        {!! $menu['content'] !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach

</div>

@endsection
