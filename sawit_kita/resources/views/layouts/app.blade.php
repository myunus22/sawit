<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SawitKita - Sistem Pakar & AI Penyakit Kelapa Sawit</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .bg-pattern {
            background-color: #f4f6f0;
            background-image: radial-gradient(#2d6a4f 0.5px, transparent 0.5px), radial-gradient(#2d6a4f 0.5px, #f4f6f0 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-opacity: 0.05;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col text-gray-800">
    <!-- Navbar -->
    <nav class="bg-emerald-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand/Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <!-- Palm Tree SVG Icon -->
                        <svg class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                        <span class="font-bold text-xl tracking-tight">Sawit<span class="text-amber-400">Kita</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-emerald-800 {{ request()->routeIs('dashboard') ? 'bg-emerald-800 text-amber-400' : 'text-gray-200' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('diagnose.ai') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-emerald-800 {{ request()->routeIs('diagnose.ai') ? 'bg-emerald-800 text-amber-400' : 'text-gray-200' }}">
                        Kamera AI
                    </a>
                    <a href="{{ route('diagnose.expert') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-emerald-800 {{ request()->routeIs('diagnose.expert') ? 'bg-emerald-800 text-amber-400' : 'text-gray-200' }}">
                        Tanya Jawab
                    </a>
                    <a href="{{ route('diseases.catalog') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-emerald-800 {{ request()->routeIs('diseases.catalog') ? 'bg-emerald-800 text-amber-400' : 'text-gray-200' }}">
                        Katalog Sawit
                    </a>
                    <a href="{{ route('diagnose.history') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-emerald-800 {{ request()->routeIs('diagnose.history') ? 'bg-emerald-800 text-amber-400' : 'text-gray-200' }}">
                        Riwayat
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-emerald-800 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden bg-emerald-950" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                    Dashboard
                </a>
                <a href="{{ route('diagnose.ai') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                    Kamera AI (CNN)
                </a>
                <a href="{{ route('diagnose.expert') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                    Tanya Jawab (Sistem Pakar)
                </a>
                <a href="{{ route('diseases.catalog') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                    Katalog Sawit
                </a>
                <a href="{{ route('diagnose.history') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                    Riwayat Diagnosis
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow py-8 bg-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Message Banner -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="text-green-700 hover:text-green-900 font-bold" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-emerald-950 text-emerald-200 border-t border-emerald-900 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left sm:flex sm:justify-between sm:items-center">
            <div>
                <p class="font-semibold text-white">Sistem Pakar & AI Penyakit Kelapa Sawit (CNN)</p>
                <p class="text-xs text-emerald-400 mt-1">Mengintegrasikan Deteksi Penyakit Daun & Kalkulator Resep Pemulihan Hara Presisi Berbasis Umur Tanaman.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <p class="text-xs">&copy; 2026 SawitKita. Skripsi Mahasiswa Agroteknologi & Teknik Informatika.</p>
                <p class="text-[10px] text-emerald-500 mt-0.5">Metode: Convolutional Neural Network (CNN) & Forward Chaining.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
