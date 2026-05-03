<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vexora · Masuk</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Inter -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap">

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* Animasi float */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        /* Animasi fade in */
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

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* LAYER 3 - PALING BELAKANG (BACKGROUND PUTIH POLOS) */
        .layer-3 {
            position: fixed;
            inset: 0;
            background-color: white;
            z-index: 0;
            pointer-events: none;
        }

        /* LAYER 2 - TENGAH (BACKGROUND LOGO) */
        .layer-2 {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Background logo di layer 2 */
        .bg-logo-container {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bg-logo-container img {
            width: 90%;
            max-width: 1000px;
            height: auto;
            object-fit: contain;
            filter: none;
            -webkit-filter: none;
        }

        /* LAYER 1 - PALING DEPAN (FORM + LOGO DI ATAS) */
        .layer-1 {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            pointer-events: none;
        }

        /* Logo VEXORA DI ATAS FORM (DI LUAR CARD) */
        .vexora-logo-top {
            position: relative;
            z-index: 15;
            display: flex;
            justify-content: center;
            padding-top: 2.5rem;
            padding-bottom: 1rem;
            pointer-events: none;
        }

        .vexora-logo-top img {
            height: 106px;
            width: auto;
            object-fit: contain;
            filter: none;
            -webkit-filter: none;
            pointer-events: auto;
        }

        /* Form wrapper */
        .form-wrapper {
            pointer-events: auto;
            flex: 1;
            display: flex;
            align-items: flex-start;
            /* Ubah dari center ke flex-start */
            justify-content: center;
            padding: 0 1rem 2rem 1rem;
        }

        /* Login Card */
        .login-card {
            background-color: white;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.15), 0 5px 15px -5px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 460px;
            backdrop-filter: none;
        }

        /* Hover effect untuk social buttons */
        .social-btn {
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Input focus effects */
        .input-focus-effect:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        /* Pastikan gambar tidak blur */
        img {
            filter: none;
            -webkit-filter: none;
            image-rendering: auto;
        }

        /* Mobile adjustments */
        @media (max-width: 1024px) {
            .vexora-logo-top img {
                height: 70px;
            }

            .vexora-logo-top {
                padding-top: 2rem;
            }
        }

        @media (max-width: 640px) {
            .vexora-logo-top img {
                height: 60px;
            }

            .vexora-logo-top {
                padding-top: 1.5rem;
            }

            .login-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white">

    <!-- LAYER 3: Background Putih Polos (TANPA ILUSTRASI) -->
    <div class="layer-3"></div>

    <!-- LAYER 2: Background Logo -->
    <div class="layer-2">
        <div class="bg-logo-container">
            <img src="{{ asset('assets/images/bg-logo-remake.jpeg') }}" alt="Background Logo" class="animate-float">
        </div>
    </div>

    <!-- LAYER 1: Form Login + Logo VEXORA di Atas -->
    <div class="layer-1">

        <!-- LOGO VEXORA DI ATAS FORM (DI LUAR CARD) -->
        <div class="vexora-logo-top">
            <img src="{{ asset('assets/images/logo-remove.png') }}" alt="Vexora Logo">
        </div>

        <div class="form-wrapper">
            <div class="login-card animate-fade-in">

                <!-- Card Header (tanpa logo di dalam) -->
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        Masuk ke Vexora
                    </h1>
                    <a href="{{ route('register') }}"
                        class="text-sm text-[#2563EB] hover:text-[#1d4ed8] font-medium transition-colors duration-200">
                        Daftar
                    </a>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email/Phone Field -->
                    <div class="space-y-2">

                        <!-- Email / Phone -->
                        <input type="text" name="login" placeholder="Email atau Nomor Telepon"
                            value="{{ old('login') }}" required
                            class="w-full px-5 py-4 rounded-xl border border-gray-300 bg-white input-focus-effect">

                        <!-- Password -->
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full px-5 py-4 rounded-xl border border-gray-300 bg-white input-focus-effect">

                        @error('login')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-between">
                            <p class="text-xs text-gray-500">
                                Contoh: 08123456789 atau user@email.com
                            </p>

                            <a href="#"
                                class="text-xs text-[#2563EB] hover:text-[#1d4ed8] font-medium transition-colors duration-200">
                                Butuh Bantuan?
                            </a>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-[#2563EB] hover:bg-[#1d4ed8] text-white font-semibold py-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                        Selanjutnya
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center my-8">
                    <div class="flex-1 h-px bg-gray-300"></div>
                    <span class="px-4 text-sm text-gray-500 font-medium">atau masuk dengan</span>
                    <div class="flex-1 h-px bg-gray-300"></div>
                </div>

                <!-- Social Login Buttons -->
                <div class="space-y-3">
                    <!-- Google -->
                    <a href="{{ route('google.login') }}"
                        class="social-btn w-full flex items-center justify-center gap-3 px-4 py-3.5 bg-white border border-gray-300 hover:border-gray-400 rounded-xl text-gray-700 font-medium transition-all duration-200">

                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>

                        <span class="flex-1 text-center">
                            Login dengan Google
                        </span>

                    </a>

                    <!-- Yahoo -->
                    <button
                        class="social-btn w-full flex items-center justify-center gap-3 px-4 py-3.5 bg-white border border-gray-300 hover:border-gray-400 rounded-xl text-gray-700 font-medium">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#6001D2"
                                d="M13.5 3L18 15h-2.5l-1-2.5h-4L9.5 15H7L11.5 3h2zM12 7.5L10.5 11h3L12 7.5zM18 18v3H6v-3h12z" />
                        </svg>
                        <span class="flex-1 text-center">Yahoo</span>
                    </button>

                    <!-- Microsoft -->
                    <button
                        class="social-btn w-full flex items-center justify-center gap-3 px-4 py-3.5 bg-white border border-gray-300 hover:border-gray-400 rounded-xl text-gray-700 font-medium">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#F25022" d="M11.4 11.4H4V4h7.4v7.4z" />
                            <path fill="#7FBA00" d="M20 11.4h-7.4V4H20v7.4z" />
                            <path fill="#00A4EF" d="M11.4 20H4v-7.4h7.4V20z" />
                            <path fill="#FFB900" d="M20 20h-7.4v-7.4H20V20z" />
                        </svg>
                        <span class="flex-1 text-center">Microsoft</span>
                    </button>
                </div>

                <!-- Footer Note -->
                <p class="text-xs text-gray-500 text-center mt-6">
                    Dengan melanjutkan, Anda menyetujui
                    <a href="#" class="text-[#2563EB] hover:underline">Syarat & Ketentuan</a>
                    dan
                    <a href="#" class="text-[#2563EB] hover:underline">Kebijakan Privasi</a>
                    Vexora.
                </p>
            </div>
        </div>
    </div>

</body>

</html>
