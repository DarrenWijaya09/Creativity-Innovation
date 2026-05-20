@if($type == 'list')
    {{-- Empty conversation list state --}}
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-inbox text-gray-300 text-2xl"></i>
        </div>
        <h4 class="font-semibold text-gray-800 mb-1">Belum ada percakapan</h4>
        <p class="text-gray-500 text-sm mb-4 max-w-xs mx-auto">
            Mulai pesan jasa untuk memulai percakapan dengan penyedia
        </p>
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-1 text-primary text-sm font-medium hover:underline">
            <i class="fas fa-search text-xs"></i>
            Cari Jasa
        </a>
    </div>
@else
    {{-- Empty main panel state --}}
    <div class="flex flex-col items-center justify-center h-full min-h-[500px] p-8 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-5">
            <i class="fas fa-envelope-open-text text-gray-300 text-3xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Pilih percakapan</h3>
        <p class="text-gray-500 text-sm max-w-sm mb-6">
            Pilih percakapan dari daftar di sebelah kiri untuk mulai berkomunikasi dengan penyedia jasa
        </p>
        <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition shadow-sm">
            <i class="fas fa-search text-sm"></i>
            Cari Jasa Sekarang
        </a>
    </div>
@endif
