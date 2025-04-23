@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('meta')
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $settings = $settings ?? \Illuminate\Support\Facades\DB::table('settings')->first();
@endphp
<link rel="icon" type="image/png" href="{{ !empty($settings->title_logo_path) ? asset($settings->title_logo_path) : asset('asset/logo.png') }}">
@endsection

@section('content')
<!-- Konten halaman settings -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
            <p class="text-gray-600 mt-1">Kelola pengaturan umum aplikasi.</p>
        </div>
    </div>
    
    <!-- Isi konten settings -->
</div>
@endsection

@push('scripts')
<script>
    // Script JavaScript
    console.log('Settings page loaded');
</script>
@endpush 