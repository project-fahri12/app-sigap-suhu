@extends('errors.layout')

@section('title', 'Pemeliharaan Sistem')
@section('code', '503')
@section('heading', 'Sedang Peningkatan Layanan')

@section('icon')
    <div class="relative">
        <i data-lucide="settings" class="w-32 h-32 animate-[spin_10s_linear_infinite]"></i>
        <i data-lucide="wrench"
            class="w-12 h-12 absolute -bottom-2 -right-2 bg-slate-50 p-2 rounded-full"></i>
    </div>
@endsection

@section('message')
    Kami sedang melakukan pemeliharaan rutin untuk meningkatkan performa aplikasi SIGAP.
    Tunggu sebentar lagi ya!
@endsection

@section('action')
    <div class="flex justify-center">
        <button onclick="window.location.reload()"
            class="inline-flex items-center justify-center px-6 py-3 border-2 border-emerald-600
                   text-emerald-600 hover:bg-emerald-50 font-semibold rounded-xl transition">
            <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i>
            Muat Ulang
        </button>
    </div>
@endsection
