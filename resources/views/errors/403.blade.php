@extends('errors.layout')

@section('title', 'Akses Dilarang')
@section('code', '403')
@section('heading', 'Area Terbatas!')
@section('icon')
    <i data-lucide="shield-alert" class="w-32 h-32 text-orange-500"></i>
@endsection
@section('message', 'Mohon maaf, Anda tidak memiliki izin untuk mengakses fitur ini. Hubungi admin jika ini adalah kesalahan.')