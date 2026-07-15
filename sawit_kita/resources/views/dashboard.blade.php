@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-emerald-800 to-teal-900 rounded-3xl text-white p-8 md:p-12 shadow-xl mb-10 relative overflow-hidden">
    <!-- Abstract Leaf Shape Overlay -->
    <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-12 translate-y-12">
        <svg class="w-80 h-80 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5 16 5 21C5 21 8 18 12 18C15 18 18 19 21 21C21 16 19 10 17 8Z"/>
        </svg>
    </div>

    <div class="max-w-2xl relative z-10">
        <span class="bg-emerald-750 text-amber-300 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-700/50 uppercase tracking-widest">
            Teknologi Dual-Input Terintegrasi
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold mt-4 leading-tight">
            Diagnosis Penyakit Daun & Pelepah Kelapa Sawit
        </h1>
        <p class="text-emerald-100 text-sm md:text-base mt-4 font-light leading-relaxed">
            Menjembatani celah penelitian sistem konvensional. Sistem kami tidak hanya mendeteksi jenis penyakit, tetapi secara cerdas mengidentifikasi 
            <strong>kategori umur tanaman</strong> untuk menghitung <strong>Resep Pemulihan Hara</strong> berupa dosis pupuk rehabilitasi yang sangat presisi.
        </p>
        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('diagnose.ai') }}" class="bg-amber-400 hover:bg-amber-500 text-emerald-950 font-bold px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 flex items-center space-x-2 text-sm">
                <!-- Camera Icon -->
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <circle cx="12" cy="13" r="3" />
                </svg>
                <span>Mulai Kamera AI (CNN)</span>
            </a>
            <a href="{{ route('diagnose.expert') }}" class="bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl border border-white/20 hover:border-white/40 transition transform hover:-translate-y-0.5 flex items-center space-x-2 text-sm">
                <!-- Q&A Icon -->
                <svg class="h-5 w-5 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Sistem Pakar Tanya-Jawab</span>
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
    <!-- Stat 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-emerald-100 rounded-xl text-emerald-800">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold text-gray-900">{{ $stats['total_diagnoses'] }}</span>
            <span class="block text-xs text-gray-500 uppercase tracking-wider font-semibold">Total Diagnosis</span>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-blue-100 rounded-xl text-blue-800">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold text-gray-900">{{ $stats['ai_count'] }}</span>
            <span class="block text-xs text-gray-500 uppercase tracking-wider font-semibold">Pemindaian AI</span>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-amber-100 rounded-xl text-amber-800">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold text-gray-900">{{ $stats['expert_count'] }}</span>
            <span class="block text-xs text-gray-500 uppercase tracking-wider font-semibold">Sistem Pakar</span>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-red-100 rounded-xl text-red-800">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold text-gray-900">{{ $stats['diseases_count'] }}</span>
            <span class="block text-xs text-gray-500 uppercase tracking-wider font-semibold">Jenis Penyakit</span>
        </div>
    </div>
</div>

<!-- Two Column Flow: Novelty Explanation & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left: Methods Comparison & Innovation -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Novelty Highlight -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 flex items-center space-x-2">
                <span class="p-2 bg-amber-100 text-amber-800 rounded-lg">
                    <!-- Lightbulb icon -->
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364.364l-.707.707M21 12h-1M4 12H3m3.343-5.657l.707-.707m2.828 9.9a5 5 0 113.622 0A3 3 0 0113 17H10a3 3 0 01-1.03-.21" />
                    </svg>
                </span>
                <span>Nilai Kebaruan Sistem (Research Novelty)</span>
            </h2>
            <div class="mt-6 space-y-4 text-gray-600 text-sm leading-relaxed">
                <p>
                    Penelitian terdahulu oleh <strong>Oktafanda (2022)</strong>, <strong>Satia dkk. (2022)</strong>, serta <strong>Riyadi dkk. (2026)</strong> 
                    berhasil mendeteksi bercak daun dengan akurasi sangat tinggi berkisar antara 85% hingga 95%. Namun, aplikasi mereka bersifat pasif karena hanya menampilkan label diagnosis 
                    tanpa panduan operasional.
                </p>
                <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 flex items-start space-x-3">
                    <span class="text-xl mt-0.5">🌾</span>
                    <p class="text-amber-900 font-medium text-xs leading-normal">
                        <strong>Fakta Agronomis:</strong> Tingkat kerusakan akibat patogen dan kebutuhan asupan nutrisi tanaman kelapa sawit pasca-sakit 
                        sangat dipengaruhi oleh <strong>fase usianya</strong>. Dosis rehabilitasi bibit muda (TBM) tentu berbeda jauh dengan pohon produktif (TM).
                    </p>
                </div>
                <p>
                    Aplikasi ini mengintegrasikan parameter umur tanaman kelapa sawit ke dalam sistem rekomendasi hara otomatis. Melalui 
                    <strong>Kamera AI</strong> atau <strong>Kuesioner Sistem Pakar</strong>, sistem mengidentifikasi usia kelapa sawit, mencocokkannya dengan 
                    penyakit terdeteksi, dan mengalkulasikan rekomendasi dosis pupuk yang presisi beserta kalkulator luas lahan praktis untuk petani.
                </p>
            </div>
        </div>

        <!-- Features Showcase -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- AI Camera Detail -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h.01M16 20h2M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900">Jalur 1: Kamera AI (CNN)</h3>
                <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                    Ambil foto daun kelapa sawit atau unggah file. Algoritma CNN (Convolutional Neural Network) mendeteksi pola lesi bercak secara real-time dan memberikan estimasi kategori umur visual kelapa sawit dari struktur pelepah.
                </p>
                <a href="{{ route('diagnose.ai') }}" class="inline-flex items-center space-x-1 text-xs text-blue-600 hover:text-blue-800 font-semibold mt-4">
                    <span>Coba Kamera AI</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <!-- Expert System Detail -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364.364l-.707.707M21 12h-1M4 12H3m3.343-5.657l.707-.707m2.828 9.9a5 5 0 113.622 0A3 3 0 0113 17H10a3 3 0 01-1.03-.21" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900">Jalur 2: Tanya Jawab (Sistem Pakar)</h3>
                <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                    Konsultasi interaktif menggunakan kuesioner gejala visual daun. Mesin inferensi rule-based (sistem pakar) mengidentifikasi jenis penyakit kelapa sawit berdasarkan kehadiran gejala yang dicentang oleh petani di lapangan.
                </p>
                <a href="{{ route('diagnose.expert') }}" class="inline-flex items-center space-x-1 text-xs text-amber-600 hover:text-amber-800 font-semibold mt-4">
                    <span>Mulai Kuesioner</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Right Column: Recent Activity & Catalog Shortcut -->
    <div class="space-y-8">
        <!-- Recent Diagnoses List -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center justify-between">
                <span>Aktivitas Terbaru</span>
                <a href="{{ route('diagnose.history') }}" class="text-xs text-emerald-600 hover:underline">Semua</a>
            </h2>
            <div class="space-y-4">
                @forelse($recentDiagnoses as $diag)
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between hover:bg-emerald-50/20 transition">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl">
                                @if($diag->disease->name === 'Sehat') 🌴 @else 🍂 @endif
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-gray-800">{{ $diag->disease->name }}</h4>
                                <p class="text-[10px] text-gray-400 mt-0.5">
                                    {{ $diag->ageCategory->label }} • <span class="bg-gray-200/50 text-gray-600 px-1 py-0.5 rounded text-[8px] font-semibold uppercase">{{ $diag->method }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] font-semibold text-emerald-700 block">{{ round($diag->confidence, 0) }}%</span>
                            <a href="{{ route('diagnose.show', $diag->id) }}" class="text-[10px] text-blue-600 hover:underline">Resep</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400 text-xs">
                        Belum ada diagnosis yang terekam.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Info Box -->
        <div class="bg-emerald-950 text-white p-6 rounded-3xl shadow-sm border border-emerald-900">
            <h3 class="font-bold text-sm text-amber-400">Tahukah Anda?</h3>
            <p class="text-xs text-emerald-200 mt-2 leading-relaxed">
                Tanaman Belum Menghasilkan (TBM) dikategorikan dari TBM 1 (0-12 bulan) hingga TBM 3 (25-36 bulan). Pada fase ini, kelapa sawit sangat membutuhkan asupan nitrogen (N) dan fosfor (P) tinggi untuk mempercepat pembentukan sel vegetatif baru pada pelepah pelepah awal.
            </p>
            <a href="{{ route('diseases.catalog') }}" class="block text-center mt-4 bg-emerald-800 hover:bg-emerald-750 text-white font-semibold text-xs py-2 rounded-lg transition">
                Lihat Panduan Pemupukan
            </a>
        </div>
    </div>
</div>
@endsection
