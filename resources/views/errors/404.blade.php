@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')
@section('code', '404')
@section('heading', 'Waduh! Anda Tersesat?')
@section('icon')
    <i data-lucide="map-pin-off" class="w-32 h-32"></i>
@endsection
@section('message', 'Halaman yang Anda tuju tidak tersedia atau telah dipindahkan. Pastikan alamat URL sudah benar.')