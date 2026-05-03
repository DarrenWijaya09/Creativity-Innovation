@extends('layouts.app')

@section('title', 'VEXORA — Temukan Jasa Terbaik untuk Kebutuhan Anda')

@section('content')
<!-- HERO SECTION -->
<section class="py-12 md:py-20 animate-fade-in">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 text-center lg:text-left">
            <span class="inline-block text-primary text-sm font-semibold tracking-wide uppercase bg-secondary px-4 py-1.5 rounded-full">Platform Jasa Terpercaya</span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight text-gray-900 leading-[1.2]">Temukan Jasa Terbaik<br>untuk Kebutuhan Anda</h1>
            <p class="text-gray-500 text-lg max-w-md mx-auto lg:mx-0 leading-relaxed">Dari les privat hingga layanan profesional, VEXORA menghubungkan Anda dengan penyedia jasa terpercaya dengan mudah dan cepat.</p>
            <div class="pt-2"><a href="{{ url('/catalog') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-medium px-8 py-4 rounded-full shadow-sm hover:shadow-md transition-all duration-300">Cari Jasa Sekarang <i class="fas fa-arrow-right text-sm"></i></a></div>
        </div>
        <div class="relative flex justify-center lg:justify-end">
            <div class="relative w-full max-w-md">
                <div class="absolute inset-0 bg-secondary rounded-full blur-3xl opacity-40 -z-10 scale-90"></div>
                <div class="absolute -inset-4 bg-gradient-to-tr from-secondary/30 to-transparent rounded-full blur-2xl -z-10"></div>
                <div class="animate-float-slow"><img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&h=600&fit=crop" alt="Layanan profesional" class="w-full h-auto object-contain drop-shadow-xl rounded-3xl"></div>
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm rounded-2xl px-4 py-2 shadow-sm border border-gray-100"><div class="flex items-center gap-2"><i class="fas fa-check-circle text-primary text-sm"></i><span class="text-gray-800 font-medium text-sm">10.000+ Penyedia</span></div></div>
            </div>
        </div>
    </div>
</section>

<!-- BROWSE BY CATEGORY -->
<section class="py-16 border-t border-gray-100">
    <div class="text-center mb-12"><h2 class="text-2xl md:text-3xl font-semibold text-gray-900">Jelajahi Kategori Jasa</h2><p class="text-gray-500 mt-2 text-sm">Temukan layanan yang Anda butuhkan</p></div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
        @php
            $serviceCategories = [
                ['name'=>'Les Privat','icon'=>'fas fa-chalkboard-user','bg'=>'#EFF6FF'],
                ['name'=>'Desain & Kreatif','icon'=>'fas fa-pen-ruler','bg'=>'#F8FAFC'],
                ['name'=>'Teknologi & IT','icon'=>'fas fa-code','bg'=>'#F1F5F9'],
                ['name'=>'Perbaikan Rumah','icon'=>'fas fa-tools','bg'=>'#F0FDF4'],
                ['name'=>'Kesehatan & Fitness','icon'=>'fas fa-heartbeat','bg'=>'#FFF7ED'],
                ['name'=>'Jasa Harian','icon'=>'fas fa-broom','bg'=>'#FEF2F2']
            ];
        @endphp
        @foreach($serviceCategories as $cat)
        <div class="group flex flex-col items-center p-5 bg-white rounded-2xl border border-gray-100 hover:shadow-lg hover:border-transparent transition-all duration-300 cursor-pointer hover-lift">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl mb-3 transition group-hover:scale-105" style="background-color: {{ $cat['bg'] }}; color: #3B82F6;">
                <i class="{{ $cat['icon'] }}"></i>
            </div>
            <span class="font-medium text-gray-800 text-sm">{{ $cat['name'] }}</span>
        </div>
        @endforeach
    </div>
</section>

<!-- PROMO BANNER -->
<section class="py-12">
    <div class="bg-secondary/30 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-10 border border-primary/10 shadow-sm">
        <div class="flex-1 text-center md:text-left space-y-4">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900">Temukan Jasa Berkualitas<br>dengan Harga Terjangkau</h3>
            <p class="text-gray-600 max-w-sm mx-auto md:mx-0">Dapatkan penawaran terbaik dari penyedia jasa terpercaya di berbagai bidang.</p>
            <div class="flex justify-center md:justify-start gap-3 pt-2">
                <div class="bg-white rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px]"><span class="text-2xl font-bold text-primary" id="days">00</span><p class="text-[10px] uppercase tracking-wide text-gray-500">Hari</p></div>
                <div class="bg-white rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px]"><span class="text-2xl font-bold text-primary" id="hours">00</span><p class="text-[10px] uppercase tracking-wide text-gray-500">Jam</p></div>
                <div class="bg-white rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px]"><span class="text-2xl font-bold text-primary" id="minutes">00</span><p class="text-[10px] uppercase tracking-wide text-gray-500">Menit</p></div>
                <div class="bg-white rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px]"><span class="text-2xl font-bold text-primary" id="seconds">00</span><p class="text-[10px] uppercase tracking-wide text-gray-500">Detik</p></div>
            </div>
            <a href="{{ url('/catalog') }}" class="inline-block bg-primary text-white px-7 py-3 rounded-full text-sm font-medium hover:bg-primary/90 transition shadow-sm mt-2">Lihat Semua Jasa →</a>
        </div>
        <div class="flex-1 flex justify-center md:justify-end"><img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=400&h=400&fit=crop" alt="Penyedia jasa" class="w-56 md:w-64 object-contain drop-shadow-md rounded-2xl hover:scale-105 transition duration-500"></div>
    </div>
</section>

<!-- LAYANAN POPULER -->
<section class="py-16">
    <div class="flex items-end justify-between flex-wrap mb-10">
        <div><h2 class="text-2xl md:text-3xl font-semibold text-gray-900">Layanan Populer</h2><p class="text-gray-500 text-sm mt-1">Pilihan terbaik dari para penyedia jasa</p></div>
        <a href="{{ url('/catalog') }}" class="text-primary text-sm font-medium border-b border-primary/30 hover:border-primary transition">Lihat semua <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
            $services = [
                ['title'=>'Les Matematika SMA','provider'=>'Bunda Sari','rating'=>5,'reviews'=>128,'location'=>'Jakarta Selatan','price'=>50000,'desc'=>'Metode mudah dan menyenangkan','img'=>'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=300&fit=crop'],
                ['title'=>'Desain Logo Profesional','provider'=>'Design Studio ID','rating'=>5,'reviews'=>342,'location'=>'Online','price'=>250000,'desc'=>'Desain modern dan unik','img'=>'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400&h=300&fit=crop'],
                ['title'=>'Perbaikan AC & Kulkas','provider'=>'Technician Plus','rating'=>4,'reviews'=>89,'location'=>'Jabodetabek','price'=>150000,'desc'=>'Teknisi profesional','img'=>'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop'],
                ['title'=>'Les Bahasa Inggris','provider'=>'English Buddy','rating'=>5,'reviews'=>256,'location'=>'Jakarta Utara','price'=>75000,'desc'=>'Native speaker','img'=>'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&h=300&fit=crop'],
            ];
        @endphp
        @foreach($services as $service)
        <div class="group bg-white rounded-2xl hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 overflow-hidden">
            <div class="card-image-zoom"><img src="{{ $service['img'] }}" alt="{{ $service['title'] }}" class="w-full h-48 object-cover"></div>
            <div class="p-5">
                <h3 class="font-bold text-gray-900 text-lg">{{ $service['title'] }}</h3>
                <p class="text-gray-500 text-sm">{{ $service['provider'] }}</p>
                <div class="flex items-center gap-1 mt-2"><i class="fas fa-star text-yellow-400 text-sm"></i><span class="font-semibold">{{ $service['rating'] }}</span><span class="text-xs text-gray-500">({{ $service['reviews'] }})</span></div>
                <div class="mt-3"><span class="text-xl font-bold text-primary">Rp{{ number_format($service['price'],0,',','.') }}</span><span class="text-xs text-gray-400 ml-1">/ sesi</span></div>
                <a href="#" class="mt-4 block text-center text-primary text-sm font-medium border border-primary/30 rounded-full py-2 hover:bg-primary hover:text-white transition">Pesan Layanan</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-14"><a href="{{ url('/catalog') }}" class="px-8 py-3 rounded-full border border-gray-300 text-gray-700 text-sm font-medium hover:border-primary hover:text-primary transition">Cari Jasa Lainnya</a></div>
</section>

<!-- TESTIMONIALS -->
<section class="py-16 bg-gray-50/50 rounded-3xl my-8">
    <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900">Apa Kata Pengguna</h2>
        <p class="text-gray-500 mt-2 text-sm">Dipercaya ribuan pengguna setiap hari</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            $testimonials = [
                ['name'=>'Anita Wijaya','feedback'=>'VEXORA sangat membantu saya menemukan guru les dengan cepat dan terpercaya.','rating'=>5,'avatar'=>'https://randomuser.me/api/portraits/women/44.jpg'],
                ['name'=>'Budi Santoso','feedback'=>'Saya cari tukang perbaikan AC di sini, dalam 1 jam langsung datang.','rating'=>5,'avatar'=>'https://randomuser.me/api/portraits/men/32.jpg'],
                ['name'=>'Citra Lestari','feedback'=>'Desain logo saya dikerjakan dengan sangat baik. Penyedia jasa responsif.','rating'=>4,'avatar'=>'https://randomuser.me/api/portraits/women/68.jpg']
            ];
        @endphp
        @foreach($testimonials as $t)
        <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-gray-100">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ $t['avatar'] }}" class="w-12 h-12 rounded-full object-cover border-2 border-primary/20">
                <div>
                    <h4 class="font-bold text-gray-800">{{ $t['name'] }}</h4>
                    <div class="flex items-center gap-1 mt-1">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $t['rating'])
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                            @else
                                <i class="far fa-star text-gray-300 text-xs"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <p class="text-gray-600">"{{ $t['feedback'] }}"</p>
        </div>
        @endforeach
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="py-16">
    <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900">Cara Kerja VEXORA</h2>
        <p class="text-gray-500 mt-2 text-sm">Mudah, cepat, dan terpercaya</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        @php
            $steps = [
                ['icon'=>'fas fa-search','title'=>'Cari Jasa','desc'=>'Temukan layanan yang Anda butuhkan dari berbagai kategori','number'=>'01'],
                ['icon'=>'fas fa-handshake','title'=>'Pilih Penyedia','desc'=>'Lihat profil, rating, dan pilih penyedia terbaik','number'=>'02'],
                ['icon'=>'fas fa-check-circle','title'=>'Pesan & Selesai','desc'=>'Lakukan pemesanan dan nikmati layanan berkualitas','number'=>'03']
            ];
        @endphp
        @foreach($steps as $step)
        <div class="text-center group">
            <div class="relative inline-block mb-6">
                <div class="w-24 h-24 bg-secondary rounded-2xl flex items-center justify-center mx-auto group-hover:bg-primary/10 transition">
                    <i class="{{ $step['icon'] }} text-3xl text-primary"></i>
                </div>
                <span class="absolute -top-3 -right-3 bg-white text-primary font-bold text-sm w-8 h-8 rounded-full border border-primary/20 flex items-center justify-center">{{ $step['number'] }}</span>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $step['title'] }}</h3>
            <p class="text-gray-500 max-w-xs mx-auto">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- STATISTICS -->
<section class="py-16 bg-primary/5 rounded-3xl my-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        @php
            $stats = [
                ['value'=>'10.000+','label'=>'Penyedia Jasa','icon'=>'fas fa-users'],
                ['value'=>'50.000+','label'=>'Pengguna Aktif','icon'=>'fas fa-user-check'],
                ['value'=>'100.000+','label'=>'Transaksi Berhasil','icon'=>'fas fa-chart-line'],
                ['value'=>'4.9/5','label'=>'Rating Pengguna','icon'=>'fas fa-star']
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="p-6">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                <i class="{{ $stat['icon'] }} text-primary text-xl"></i>
            </div>
            <div class="text-3xl md:text-4xl font-extrabold text-gray-900">{{ $stat['value'] }}</div>
            <div class="text-gray-500 text-sm mt-1">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-16">
    <div class="bg-primary rounded-3xl p-12 md:p-16 text-center text-white shadow-xl">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Menemukan Jasa Terbaik?</h2>
        <p class="text-blue-100 text-lg max-w-xl mx-auto mb-8">Mulai sekarang dan temukan layanan terpercaya hanya di VEXORA.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/catalog') }}" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">Cari Jasa</a>
            <a href="#" class="inline-block bg-primary/20 border border-white/40 text-white font-semibold px-8 py-3 rounded-full hover:bg-white/10 transition">Jadi Penyedia</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initCountdown({ days: 'days', hours: 'hours', minutes: 'minutes', seconds: 'seconds' });
    });
</script>
@endpush
