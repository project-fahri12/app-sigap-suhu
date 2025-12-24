@extends('errors.layout')

@section('title', 'Sesi Berakhir')
@section('code', '419')
@section('heading', 'Sesi Keamanan Berakhir')
@section('icon')
    <i data-lucide="timer" class="w-32 h-32"></i>
@endsection
@section('message', 'Demi keamanan, sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas. Silakan segarkan halaman.')