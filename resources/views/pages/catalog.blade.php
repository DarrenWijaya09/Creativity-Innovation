@extends('layouts.app')

@section('title', 'Temukan Penyedia Jasa Terbaik - VEXORA')

@section('content')
<div class="mb-8 text-center md:text-left">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Penyedia Jasa Terbaik</h1>
    <p class="text-gray-500 mt-2">Jelajahi berbagai layanan profesional sesuai kebutuhan Anda</p>
</div>

<div class="flex flex-col lg:flex-row gap-8">
    <!-- Left Sidebar (Filters) -->
    <aside class="lg:w-80 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24 filter-sidebar">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-lg text-gray-900">Filter</h2>
                <button id="resetFiltersBtn" class="text-primary text-sm font-medium hover:underline">Reset Filter</button>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Kategori Jasa</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Les Privat</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Desain & Kreatif</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Teknologi & IT</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Perbaikan Rumah</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Kesehatan & Fitness</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Jasa Harian</span></label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Lokasi</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Jakarta</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Bandung</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Surabaya</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Online</span></label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Rating</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="radio" name="rating" class="text-primary"><span class="flex items-center">⭐ 4 ke atas</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="radio" name="rating" class="text-primary"><span class="flex items-center">⭐ 3 ke atas</span></label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Harga</h3>
                <div class="flex gap-2 items-center">
                    <input type="number" placeholder="Min" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                    <span class="text-gray-400">—</span>
                    <input type="number" placeholder="Max" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-800 mb-3">Tipe Layanan</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Online</span></label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input type="checkbox" class="filter-checkbox rounded text-primary"><span>Offline (Datang ke lokasi)</span></label>
                </div>
            </div>

            <button class="w-full mt-4 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">Terapkan Filter</button>
        </div>
    </aside>

    <!-- Right Content -->
    <div class="flex-1">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <p class="text-gray-600 text-sm">Menampilkan <span class="font-semibold text-gray-900">120</span> penyedia jasa</p>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Urutkan:</span>
                <select class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary bg-white">
                    <option>Terpopuler</option>
                    <option>Rating Tertinggi</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $services = [
                    ['title'=>'Les Matematika SMA','provider'=>'Bunda Sari','rating'=>5,'reviews'=>128,'location'=>'Jakarta Selatan','price'=>50000,'desc'=>'Metode mudah dan menyenangkan, guru berpengalaman 10+ tahun','img'=>'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=300&fit=crop','badge'=>'Online & Offline'],
                    ['title'=>'Desain Logo Profesional','provider'=>'Design Studio ID','rating'=>5,'reviews'=>342,'location'=>'Online','price'=>250000,'desc'=>'Desain modern dan unik sesuai identitas brand Anda','img'=>'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400&h=300&fit=crop','badge'=>'Online'],
                    ['title'=>'Perbaikan AC & Kulkas','provider'=>'Technician Plus','rating'=>4,'reviews'=>89,'location'=>'Jabodetabek','price'=>150000,'desc'=>'Teknisi profesional, garansi 30 hari','img'=>'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop','badge'=>'Offline'],
                    ['title'=>'Les Bahasa Inggris','provider'=>'English Buddy','rating'=>5,'reviews'=>256,'location'=>'Jakarta Utara','price'=>75000,'desc'=>'Native speaker, jadwal fleksibel','img'=>'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&h=300&fit=crop','badge'=>'Online & Offline'],
                    ['title'=>'Website Company Profile','provider'=>'WebDev Expert','rating'=>5,'reviews'=>94,'location'=>'Online','price'=>1500000,'desc'=>'Responsif, SEO friendly, cepat selesai','img'=>'https://images.unsplash.com/photo-1547658719-da2b51169166?w=400&h=300&fit=crop','badge'=>'Online'],
                    ['title'=>'Pijat Kebugaran','provider'=>'Sehat Sejati','rating'=>4,'reviews'=>67,'location'=>'Jakarta Pusat','price'=>120000,'desc'=>'Terapis profesional, alat lengkap','img'=>'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=400&h=300&fit=crop','badge'=>'Offline'],
                ];
            @endphp
            @foreach($services as $service)
            <div class="group bg-white rounded-2xl hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 overflow-hidden">
                <div class="card-image-zoom relative">
                    <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="w-full h-48 object-cover">
                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-medium px-2 py-1 rounded-full text-gray-700 shadow-sm">{{ $service['badge'] }}</span>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $service['title'] }}</h3>
                            <p class="text-gray-500 text-sm mt-0.5">{{ $service['provider'] }}</p>
                        </div>
                        <div class="flex items-center gap-1 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                            <span class="text-sm font-semibold text-gray-800">{{ $service['rating'] }}</span>
                            <span class="text-xs text-gray-500">({{ $service['reviews'] }})</span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $service['desc'] }}</p>
                    <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                        <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-primary/70 text-xs"></i> {{ $service['location'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-extrabold text-primary">Rp{{ number_format($service['price'],0,',','.') }}</span>
                            <span class="text-xs text-gray-400 ml-1">/ sesi</span>
                        </div>
                        <a href="#" class="px-5 py-2 bg-primary/10 text-primary font-semibold text-sm rounded-xl hover:bg-primary hover:text-white transition-all duration-200">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-center gap-2 mt-10">
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i class="fas fa-chevron-left text-sm"></i></button>
            <button class="px-3 py-2 rounded-lg bg-primary text-white">1</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">2</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">3</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50">...</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i class="fas fa-chevron-right text-sm"></i></button>
        </div>

        <div class="mt-12 bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-8 md:p-10 text-center text-white shadow-lg">
            <i class="fas fa-store text-4xl mb-4 opacity-80"></i>
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Jadi Penyedia di VEXORA</h2>
            <p class="text-blue-100 max-w-lg mx-auto mb-6">Gabung dan tawarkan jasa Anda kepada ribuan pengguna yang membutuhkan layanan profesional.</p>
            <a href="#" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">Daftar Sekarang →</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('resetFiltersBtn')?.addEventListener('click', function() {
        document.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
        document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
        document.querySelectorAll('input[type="number"]').forEach(input => input.value = '');
    });
</script>
@endpush
