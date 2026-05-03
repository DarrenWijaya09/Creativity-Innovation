<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VEXORA — Platform Jasa Terpercaya')</title>

    <!-- Tailwind CSS CDN + Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @stack('styles')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#EFF6FF',
                        accent: '#FEF9C3',
                    },
                    animation: {
                        'float-slow': 'float 4s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.6s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * {
            -webkit-font-smoothing: antialiased;
        }
        body {
            background: #ffffff;
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
        @stack('custom_css')
    </style>
</head>
<body class="font-sans text-gray-800 bg-white @stack('body_class')">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="@yield('main_class', 'max-w-7xl mx-auto px-6 lg:px-8')">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Global Scripts -->
    <script>
        // Global countdown timer function
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
                if(diff <= 0) {
                    timerDate = getEndDate();
                    updateTimer();
                    return;
                }
                const days = Math.floor(diff / (1000*60*60*24));
                const hours = Math.floor((diff % (86400000)) / (3600000));
                const minutes = Math.floor((diff % 3600000) / 60000);
                const seconds = Math.floor((diff % 60000) / 1000);

                if (document.getElementById(elementIds.days)) {
                    document.getElementById(elementIds.days).innerText = days < 10 ? '0'+days : days;
                    document.getElementById(elementIds.hours).innerText = hours < 10 ? '0'+hours : hours;
                    document.getElementById(elementIds.minutes).innerText = minutes < 10 ? '0'+minutes : minutes;
                    document.getElementById(elementIds.seconds).innerText = seconds < 10 ? '0'+seconds : seconds;
                }
            }
            updateTimer();
            setInterval(updateTimer, 1000);
        }
    </script>

    @stack('scripts')
</body>
</html>
