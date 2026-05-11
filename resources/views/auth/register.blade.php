<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vexora · Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* Animasi fade in up untuk elemen */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi slide in dari kiri */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animasi slide in dari kanan */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animasi float untuk maskot (LEBIH LAMBAT DAN LEMBUT) */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Kelas animasi */
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-slide-left {
            animation: slideInLeft 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-slide-right {
            animation: slideInRight 0.8s ease-out forwards;
            opacity: 0;
        }

        /* ANIMASI KHUSUS MASKOT */
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        /* Delay animations */
        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-150 {
            animation-delay: 150ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-250 {
            animation-delay: 250ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-350 {
            animation-delay: 350ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .delay-450 {
            animation-delay: 450ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }

        /* LOGO TANPA EFEK HOVER */
        .logo-static {
            /* tidak ada efek hover */
        }

        /* Hover effects untuk elemen lain */
        .hover-lift {
            transition: box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Input focus effects */
        .input-focus-effect {
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-focus-effect:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Tombol tanpa efek translate */
        .btn-transition {
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-transition:hover {
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col">

    <!-- LOGO - TANPA EFEK HOVER SAMA SEKALI -->
    <div class="flex justify-center pt-6 pb-4">
        <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Vexora Logo"
            class="h-16 sm:h-20 lg:h-24 xl:h-28 2xl:h-32 object-contain logo-static">
    </div>

    <!-- MAIN GRID -->
    <div class="flex-1 grid lg:grid-cols-2 items-center">

        <!-- LEFT SIDE dengan slide from left -->
        <div
            class="flex flex-col items-center text-center px-8 lg:px-16 py-10 lg:py-0 -mt-6 lg:-mt-10 animate-slide-left">
            <!-- MASKOT DENGAN ANIMASI FLOAT -->
            <div class="animate-float">
                <img src="{{ asset('assets/images/image.png') }}" alt="Vexora Mascot"
                    class="w-full max-w-sm sm:max-w-md lg:max-w-2xl xl:max-w-3xl 2xl:max-w-4xl mb-6 object-contain">
            </div>

            <p class="text-xl sm:text-2xl lg:text-3xl text-gray-600 leading-relaxed animate-fade-in-up delay-100">
                Hubungkan Kebutuhan,<br>
                Hadirkan Solusi IT.
            </p>

            <p
                class="text-sm sm:text-base text-gray-500 mt-6 border-t border-blue-100 pt-4 max-w-md animate-fade-in-up delay-200">
                Gabung dan temukan solusi IT terlengkap hanya di Vexora.
            </p>
        </div>

        <!-- RIGHT SIDE FORM dengan slide from right -->
        <div class="flex justify-center px-6 py-10 lg:py-0 animate-slide-right">
            <div class="w-full max-w-md">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-6 animate-fade-in-up">
                    <h2 class="text-2xl font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-200">
                        Daftar
                    </h2>

                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="text-blue-600 font-medium hover:underline hover:text-blue-800 transition-colors duration-200">
                            Masuk
                        </a>
                    </p>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Nama -->
                    <div class="animate-fade-in-up delay-100">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" required="required"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- Tanggal -->
                    <div class="animate-fade-in-up delay-150">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Lahir
                        </label>
                        <input type="date" name="birth_date" required="required"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- Telepon -->
                    <div class="animate-fade-in-up delay-200">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor Telepon
                        </label>
                        <input type="tel" name="phone" required="required"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- Email -->
                    <div class="animate-fade-in-up delay-250">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="email" name="email" required="required"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- Password -->
                    <div class="animate-fade-in-up delay-300">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" required="required"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- Password Confirmation -->
                    <div class="animate-fade-in-up delay-350">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 input-focus-effect hover:border-blue-300">
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-[#2563EB] hover:bg-[#1d4ed8] text-white font-semibold py-3 rounded-xl shadow-md shadow-blue-200 btn-transition animate-fade-in-up delay-350">
                        Daftar
                    </button>
                </form>

                <!-- OR -->
                <div class="flex items-center my-6 animate-fade-in-up delay-400">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="px-4 text-sm text-gray-400 font-medium">
                        atau
                    </span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- GOOGLE LOGIN -->
                <a href="{{ route('google.login') }}"
                    class="w-full flex items-center justify-center gap-3 border border-gray-300 hover:border-blue-300 bg-white text-gray-700 font-medium py-3 rounded-xl shadow-sm btn-transition animate-fade-in-up delay-450">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>

                    <span class="hover:text-blue-600 transition-colors duration-200">
                        Daftar dengan Google
                    </span>

                </a>

                <!-- FOOTER -->
                <p class="text-xs text-gray-500 text-center mt-6 leading-relaxed animate-fade-in-up delay-500">
                    Dengan mendaftar, saya menyetujui
                    <a href="{{ route('syarat-ketentuan') }}"
                        class="text-blue-600 hover:underline hover:text-blue-800 transition-colors duration-200">
                        Syarat & Ketentuan
                    </a>
                    serta
                    <a href="{{ route('syarat-ketentuan') }}"
                        class="text-blue-600 hover:underline hover:text-blue-800 transition-colors duration-200">
                        Kebijakan Privasi
                    </a>
                    Vexora.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
