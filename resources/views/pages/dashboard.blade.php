@extends('layouts.app')

@section('title', 'Dashboard - VEXORA')

@section('main_class', 'max-w-7xl mx-auto px-6 lg:px-8 py-10')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Dashboard</h1>
    <p class="text-gray-500 mb-6">Selamat datang kembali! Ini adalah halaman contoh untuk menunjukkan struktur layout.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-secondary/30 rounded-xl p-6 text-center">
            <i class="fas fa-users text-primary text-3xl mb-3"></i>
            <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
            <p class="text-gray-500 text-sm">Total Pengguna</p>
        </div>
        <div class="bg-secondary/30 rounded-xl p-6 text-center">
            <i class="fas fa-briefcase text-primary text-3xl mb-3"></i>
            <h3 class="text-2xl font-bold text-gray-800">567</h3>
            <p class="text-gray-500 text-sm">Penyedia Aktif</p>
        </div>
        <div class="bg-secondary/30 rounded-xl p-6 text-center">
            <i class="fas fa-chart-line text-primary text-3xl mb-3"></i>
            <h3 class="text-2xl font-bold text-gray-800">Rp 12,5M</h3>
            <p class="text-gray-500 text-sm">Total Transaksi</p>
        </div>
    </div>

    <div class="mt-8 p-6 bg-gray-50 rounded-xl">
        <h2 class="font-semibold text-gray-800 mb-3">Aktivitas Terbaru</h2>
        <ul class="space-y-3 text-gray-600 text-sm">
            <li class="flex items-center gap-3"><i class="fas fa-circle text-primary text-xs"></i> Pengguna baru mendaftar sebagai penyedia jasa</li>
            <li class="flex items-center gap-3"><i class="fas fa-circle text-primary text-xs"></i> 25 transaksi berhasil hari ini</li>
            <li class="flex items-center gap-3"><i class="fas fa-circle text-primary text-xs"></i> Kategori "Desain Grafis" menjadi yang terpopuler</li>
        </ul>
    </div>
</div>
@endsection
