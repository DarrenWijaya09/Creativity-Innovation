@extends('layouts.app')

@section('title', 'Hubungi Kami - VEXORA')

@section('content')
    <div class="animate-fade-in">

        <!-- Hero Section -->
        <section class="text-center mb-12 py-8">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Butuh Bantuan? <span class="text-primary">Kami Siap Membantu</span>
            </h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Tim VEXORA siap membantu Anda kapan saja. Isi form di bawah atau hubungi kami melalui kontak yang tersedia.
            </p>
        </section>

        <!-- Two Column Layout: Form + Quick Contact -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">

            <!-- Contact Form (2/3 width) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

                    <div class="flex items-start justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Kirim Pesan ke Kami</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Tim support VEXORA akan merespon dalam 1x24 jam kerja.
                            </p>
                        </div>

                        <div class="hidden md:flex items-center justify-center w-12 h-12 rounded-2xl bg-primary/10">
                            <i class="fas fa-headset text-primary text-lg"></i>
                        </div>
                    </div>

                    {{-- SUCCESS ALERT --}}
                    @if (session('success'))
                        <div
                            class="mb-6 rounded-2xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-start gap-3">
                            <i class="fas fa-check-circle mt-0.5"></i>

                            <div>
                                <p class="font-medium">Pesan berhasil dikirim</p>

                                <p class="text-green-600/80 text-xs mt-1">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- ERROR ALERT --}}
                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-exclamation-circle mt-0.5"></i>

                                <div>
                                    <p class="font-medium">Periksa kembali form Anda</p>

                                    <ul class="mt-2 space-y-1 text-xs text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAME --}}
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Nama Lengkap
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}"
                                    placeholder="Contoh: Budi Santoso"
                                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition @error('name') border-red-300 bg-red-50/30 @else border-gray-200 @enderror">

                                @error('name')
                                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Email
                                    <span class="text-red-500">*</span>
                                </label>

                                <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                    placeholder="budi@example.com"
                                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition @error('email') border-red-300 bg-red-50/30 @else border-gray-200 @enderror">

                                @error('email')
                                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- CATEGORY --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Kategori
                                <span class="text-red-500">*</span>
                            </label>

                            <select name="category"
                                class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white transition @error('category') border-red-300 bg-red-50/30 @else border-gray-200 @enderror">

                                <option value="">Pilih kategori</option>

                                <option value="pesanan" {{ old('category') == 'pesanan' ? 'selected' : '' }}>
                                    Masalah Pesanan
                                </option>

                                <option value="pembayaran" {{ old('category') == 'pembayaran' ? 'selected' : '' }}>
                                    Pembayaran
                                </option>

                                <option value="akun" {{ old('category') == 'akun' ? 'selected' : '' }}>
                                    Akun & Pendaftaran
                                </option>

                                <option value="penyedia" {{ old('category') == 'penyedia' ? 'selected' : '' }}>
                                    Menjadi Penyedia
                                </option>

                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>

                            </select>

                            @error('category')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- MESSAGE --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                Pesan
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea name="message" rows="6" placeholder="Ceritakan masalah atau pertanyaan Anda secara detail..."
                                class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 resize-none transition @error('message') border-red-300 bg-red-50/30 @else border-gray-200 @enderror">{{ old('message') }}</textarea>

                            <div class="flex items-center justify-between mt-2">

                                @error('message')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400">
                                        Jelaskan masalah Anda sedetail mungkin agar tim kami dapat membantu lebih cepat.
                                    </p>
                                @enderror

                                <span class="text-xs text-gray-300">
                                    Max 5000 karakter
                                </span>

                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pt-2">

                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold px-6 py-3 rounded-xl transition shadow-sm">

                                <i class="fas fa-paper-plane text-sm"></i>

                                <span>Kirim Pesan</span>

                            </button>

                            <p class="text-xs text-gray-400 flex items-center gap-2">
                                <i class="fas fa-lock"></i>
                                Data Anda aman dan hanya digunakan untuk kebutuhan support.
                            </p>

                        </div>

                    </form>

                </div>
            </div>

            <!-- Quick Contact Cards (1/3 width) -->
            <div class="space-y-4">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-envelope text-primary text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Email Support</h3>
                    <p class="text-gray-500 text-sm mt-1">Kirim email ke alamat kami</p>
                    <a href="mailto:hello@vexora.com"
                        class="text-primary font-medium text-sm hover:underline block mt-2">hello@vexora.com</a>
                    <a href="mailto:support@vexora.com"
                        class="text-primary font-medium text-sm hover:underline block">support@vexora.com</a>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fab fa-whatsapp text-green-500 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">WhatsApp</h3>
                    <p class="text-gray-500 text-sm mt-1">Chat langsung dengan tim kami</p>
                    <a href="https://wa.me/6281234567890"
                        class="text-green-600 font-medium text-sm hover:underline block mt-2">+62 812 3456 7890</a>
                    <p class="text-xs text-gray-400 mt-2">Senin - Jumat, 09:00 - 17:00</p>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-clock text-blue-500 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Jam Operasional</h3>
                    <p class="text-gray-500 text-sm mt-1">Tim support kami siap melayani</p>
                    <div class="mt-2 space-y-1 text-sm">
                        <p class="flex justify-between"><span class="text-gray-500">Senin - Jumat</span><span
                                class="text-gray-800">09:00 - 18:00</span></p>
                        <p class="flex justify-between"><span class="text-gray-500">Sabtu</span><span
                                class="text-gray-800">10:00 - 15:00</span></p>
                        <p class="flex justify-between"><span class="text-gray-500">Minggu</span><span
                                class="text-gray-800">Tutup</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <section class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-gray-500 mt-2">Temukan jawaban cepat untuk pertanyaan umum</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Bagaimana cara memesan jasa di VEXORA?</h3>
                            <p class="text-gray-500 text-sm mt-1">Cukup cari penyedia jasa sesuai kebutuhan, pilih layanan,
                                lalu klik "Pesan Sekarang". Ikuti instruksi pembayaran, dan penyedia akan menghubungi Anda.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Bagaimana cara menjadi penyedia jasa?</h3>
                            <p class="text-gray-500 text-sm mt-1">Klik tombol "Jadi Penyedia" di halaman utama, isi
                                formulir
                                pendaftaran, lengkapi profil dan layanan Anda. Tim kami akan melakukan verifikasi dalam 1x24
                                jam.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Metode pembayaran apa saja yang tersedia?</h3>
                            <p class="text-gray-500 text-sm mt-1">Kami mendukung transfer bank (BCA, Mandiri, BRI, BNI),
                                e-wallet (GoPay, OVO, Dana), dan kartu kredit/debit.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Apakah ada garansi jika layanan tidak sesuai?</h3>
                            <p class="text-gray-500 text-sm mt-1">Ya, VEXORA memberikan garansi kepuasan. Jika layanan
                                tidak sesuai, Anda dapat mengajukan komplain dan tim kami akan membantu menyelesaikan.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Berapa biaya layanan VEXORA?</h3>
                            <p class="text-gray-500 text-sm mt-1">VEXORA tidak membebankan biaya tambahan kepada pengguna.
                                Harga yang ditampilkan adalah harga dari penyedia jasa. Untuk penyedia, kami mengenakan
                                komisi transaksi yang transparan.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-question-circle text-primary text-lg mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800">Bagaimana jika saya lupa password?</h3>
                            <p class="text-gray-500 text-sm mt-1">Klik "Lupa Password" di halaman login, masukkan email
                                terdaftar. Kami akan mengirimkan link reset password ke email Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Support Flow -->
        <section class="mb-16 bg-gray-50/50 rounded-3xl py-12 px-6">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Proses Bantuan Kami</h2>
                <p class="text-gray-500 mt-2">Mudah, cepat, dan transparan</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-paper-plane text-primary text-xl"></i>
                    </div>
                    <div class="text-primary font-bold text-xl mb-2">1</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Kirim Pesan</h3>
                    <p class="text-gray-500 text-sm">Isi form atau hubungi tim support</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-primary text-xl"></i>
                    </div>
                    <div class="text-primary font-bold text-xl mb-2">2</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Tim Merespon</h3>
                    <p class="text-gray-500 text-sm">Kami akan merespon dalam 1x24 jam</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-primary text-xl"></i>
                    </div>
                    <div class="text-primary font-bold text-xl mb-2">3</div>
                    <h3 class="font-semibold text-gray-800 mb-1">Masalah Selesai</h3>
                    <p class="text-gray-500 text-sm">Solusi diberikan dan masalah terselesaikan</p>
                </div>
            </div>
        </section>

        <!-- CTA Section - Jadi Penyedia -->
        <section class="mb-16">
            <div
                class="bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-10 md:p-12 text-center text-white shadow-xl">
                <i class="fas fa-store text-4xl mb-4 opacity-80"></i>
                <h2 class="text-2xl md:text-3xl font-bold mb-3">Ingin menjadi penyedia?</h2>
                <p class="text-blue-100 max-w-lg mx-auto mb-6">
                    Bergabunglah bersama ribuan penyedia jasa yang sudah berkembang bersama VEXORA
                </p>
                <a href="#"
                    class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">
                    Daftar Sekarang →
                </a>
            </div>
        </section>

        <!-- Office / Address (Optional) -->
        <section class="pb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center">
                <i class="fas fa-map-marker-alt text-primary text-xl mb-2"></i>
                <h3 class="font-semibold text-gray-800">Kantor Pusat</h3>
                <p class="text-gray-500 text-sm">Gedung VEXORA, Jalan Teknologi No. 123, Jakarta Selatan, Indonesia 12190
                </p>
            </div>
        </section>

    </div>

    @push('styles')
        <style>
            .animate-fade-in {
                animation: fadeIn 0.5s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
