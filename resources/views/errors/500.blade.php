@extends('errors.layout')

@section('title', 'Server Error')
@section('code', '500')
@section('heading', 'Sistem Sedang Lelah')
@section('icon')
    <i data-lucide="server-crash" class="w-32 h-32 text-red-500"></i>
@endsection
@section('message', 'Terjadi kendala teknis pada server kami. Tim IT SIGAP sedang berusaha memperbaikinya secepat mungkin.')