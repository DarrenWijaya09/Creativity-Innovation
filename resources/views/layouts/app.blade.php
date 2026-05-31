<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        init() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            }
            this.$watch('darkMode', value => {
                if (value) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        }
    }"
    x-init="init">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VEXORA — Platform Jasa Terpercaya')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#EFF6FF',
                        accent: '#FEF9C3',
                        dark: {
                            DEFAULT: '#0f172a',
                            secondary: '#111827',
                            tertiary: '#1f2937',
                            border: '#374151',
                            muted: '#9ca3af'
                        }
                    },
                    animation: {
                        'float-slow': 'float 4s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.6s ease-out'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Global Styles with Dark Mode Support -->
    <style>
        * {
            -webkit-font-smoothing: antialiased;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #ffffff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark body {
            background: #020617;
            color: #f8fafc;
        }

        /* Smooth transitions for theme switching */
        * {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        /* Disable transition on page load to prevent flicker */
        .disable-transition {
            transition: none !important;
        }

        .hover-lift {
            transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
        }

        .hover-lift:hover {
            transform: translateY(-6px);
        }

        .card-image-zoom {
            overflow: hidden;
        }

        .card-image-zoom img {
            transition: transform 0.6s ease;
        }

        .card-image-zoom:hover img {
            transform: scale(1.06);
        }

        .filter-sidebar {
            scrollbar-width: thin;
        }

        .dark .filter-sidebar {
            scrollbar-color: #374151 #111827;
        }

        /* Dark mode custom scrollbar */
        .dark ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* Glass morphism dark mode support */
        .dark .bg-white\/90 {
            background-color: rgba(15, 23, 42, 0.9);
        }

        .dark .bg-white\/80 {
            background-color: rgba(15, 23, 42, 0.8);
        }

        .dark .border-gray-100 {
            border-color: #1e293b;
        }

        .dark .shadow-sm,
        .dark .shadow-md,
        .dark .shadow-lg {
            --tw-shadow-color: rgba(0, 0, 0, 0.3);
        }

        /* Form elements dark mode */
        .dark input,
        .dark textarea,
        .dark select {
            background-color: #1e293b;
            border-color: #334155;
            color: #f1f5f9;
        }

        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #64748b;
        }

        .dark input:focus,
        .dark textarea:focus,
        .dark select:focus {
            border-color: #3B82F6;
            outline: none;
        }

        /* Card dark mode */
        .dark .bg-white {
            background-color: #0f172a;
        }

        .dark .bg-gray-50 {
            background-color: #111827;
        }

        .dark .bg-gray-100 {
            background-color: #1e293b;
        }

        .dark .border-gray-100,
        .dark .border-gray-200 {
            border-color: #1e293b;
        }

        /* Button dark mode */
        .dark .bg-gray-50 {
            background-color: #1e293b;
        }

        .dark .hover\:bg-gray-50:hover {
            background-color: #334155;
        }

        .dark .hover\:bg-gray-100:hover {
            background-color: #334155;
        }

        /* Text colors */
        .dark .text-gray-400 {
            color: #94a3b8;
        }

        .dark .text-gray-500 {
            color: #64748b;
        }

        .dark .text-gray-600 {
            color: #94a3b8;
        }

        .dark .text-gray-700 {
            color: #cbd5e1;
        }

        .dark .text-gray-800 {
            color: #e2e8f0;
        }

        .dark .text-gray-900 {
            color: #f1f5f9;
        }

        /* Gradient dark mode */
        .dark .bg-gradient-to-r,
        .dark .bg-gradient-to-br,
        .dark .bg-gradient-to-tr {
            --tw-gradient-from: rgba(59, 130, 246, 0.2);
            --tw-gradient-to: rgba(59, 130, 246, 0.05);
        }

        .dark .from-primary\/5 {
            --tw-gradient-from: rgba(59, 130, 246, 0.15);
        }

        .dark .to-blue-50 {
            --tw-gradient-to: rgba(59, 130, 246, 0.05);
        }

        /* Avatar fallback dark mode */
        .dark .bg-gradient-to-br.from-gray-100.to-gray-200 {
            background: linear-gradient(to bottom right, #1e293b, #334155);
        }

        /* Markdown content dark mode */
        .dark .markdown-body {
            color: #cbd5e1;
        }

        .dark .markdown-body code:not(pre code) {
            background-color: #1e293b;
            color: #f43f5e;
        }

        .dark .markdown-body pre {
            background-color: #0f172a;
        }

        .dark .markdown-body blockquote {
            border-left-color: #334155;
            color: #94a3b8;
        }

        /* Pagination dark mode */
        .dark .pagination .page-item .page-link {
            background-color: #0f172a;
            border-color: #1e293b;
            color: #cbd5e1;
        }

        .dark .pagination .page-item.active .page-link {
            background-color: #3B82F6;
            border-color: #3B82F6;
            color: white;
        }

        .dark .pagination .page-item .page-link:hover:not(.active) {
            background-color: #1e293b;
        }

        /* Toast dark mode */
        .dark .bg-white {
            background-color: #0f172a;
        }

        .dark .border-green-100 {
            border-color: #166534;
        }

        /* Remove transition flash on load */
        .no-transition {
            transition: none !important;
        }

        @stack('custom_css')
    </style>
</head>

<body class="font-sans text-gray-800 bg-white dark:bg-gray-950 dark:text-gray-100 transition-theme @stack('body_class')">
    <x-navbar />

    @if (session('success'))
        <div id="global-toast"
            class="fixed top-20 sm:top-24 right-4 z-50 transition-all duration-300 pointer-events-none">
            <div
                class="bg-white dark:bg-gray-900 border border-green-100 dark:border-green-900 shadow-lg dark:shadow-black/30 rounded-2xl px-5 py-4 flex items-start gap-3 min-w-[320px] pointer-events-auto transition-theme">
                <div
                    class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                </div>

                <div class="flex-1">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Berhasil
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5 leading-relaxed">
                        {{ session('success') }}
                    </p>
                </div>

                <button onclick="document.getElementById('global-toast').remove()"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('global-toast');

                if (toast) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-12px)';
                    toast.style.transition = 'all 0.3s ease';

                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }
            }, 3000);
        </script>
    @endif

    <main class="@yield('main_class', 'max-w-7xl mx-auto px-6 lg:px-8')">
        @yield('content')
    </main>

    <x-footer />

    <!-- Dark Mode Toggle Helper Script -->
    <script>
        // Disable transitions temporarily on page load to prevent flash
        document.documentElement.classList.add('disable-transition');
        setTimeout(() => {
            document.documentElement.classList.remove('disable-transition');
        }, 100);

        function initCountdown(elementIds) {
            function getEndDate() {
                let date = new Date();
                date.setDate(date.getDate() + 3);
                date.setHours(23, 59, 59, 999);
                return date;
            }

            let timerDate = getEndDate();

            function updateTimer() {
                const now = new Date().getTime();
                const diff = timerDate - now;

                if (diff <= 0) {
                    timerDate = getEndDate();
                    updateTimer();
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % 86400000) / 3600000);
                const minutes = Math.floor((diff % 3600000) / 60000);
                const seconds = Math.floor((diff % 60000) / 1000);

                if (document.getElementById(elementIds.days)) {
                    document.getElementById(elementIds.days).innerText = days < 10 ? '0' + days : days;
                    document.getElementById(elementIds.hours).innerText = hours < 10 ? '0' + hours : hours;
                    document.getElementById(elementIds.minutes).innerText = minutes < 10 ? '0' + minutes : minutes;
                    document.getElementById(elementIds.seconds).innerText = seconds < 10 ? '0' + seconds : seconds;
                }
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        }

        // Expose dark mode toggle helper for components
        window.toggleDarkMode = function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        };

        // Function to get current dark mode state
        window.isDarkMode = function() {
            return document.documentElement.classList.contains('dark');
        };
    </script>

    @stack('scripts')
</body>
</html>
