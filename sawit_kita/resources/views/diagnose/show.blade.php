@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('diagnose.history') }}" class="text-xs text-emerald-700 hover:underline font-semibold flex items-center space-x-1">
            <span>&larr; Riwayat Diagnosis</span>
        </a>
        <span class="text-[10px] font-mono text-gray-400 bg-gray-100 px-2 py-1 rounded">ID: #{{ $diagnosis->id }}</span>
    </div>

    <!-- Diagnosis Result Card -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900 mb-6">Hasil Diagnosis</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-600 block">Jenis Penyakit</span>
                <h4 class="text-lg font-extrabold text-emerald-950 mt-1">{{ $diagnosis->disease->name }}</h4>
            </div>
            <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                <span class="text-[10px] uppercase font-bold tracking-wider text-blue-600 block">Kategori Umur</span>
                <h4 class="text-lg font-extrabold text-blue-950 mt-1">{{ $diagnosis->ageCategory->label }}</h4>
            </div>
        </div>

        <div class="mt-6 p-4 bg-gray-50 rounded-2xl">
            <span class="text-[10px] uppercase font-bold tracking-wider text-gray-500 block mb-2">Catatan Sistem</span>
            <p class="text-sm text-gray-700 leading-relaxed italic">{{ $diagnosis->notes }}</p>
        </div>
    </div>

    <!-- Rehabilitation / Treatment Recipe -->
    @if($rehabilitation)
        <div class="bg-emerald-950 text-white p-8 rounded-3xl shadow-lg">
            <h2 class="text-xl font-bold text-amber-400 mb-6 flex items-center space-x-2">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span>Resep Pemulihan Hara</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-emerald-900/50 p-4 rounded-xl border border-emerald-800">
                    <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-300 block">Jenis Pupuk & Tambahan</span>
                    <p class="text-lg font-semibold mt-1">{{ $rehabilitation->fertilizer_type }}</p>
                </div>
                <div class="bg-emerald-900/50 p-4 rounded-xl border border-emerald-800">
                    <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-300 block">Takaran Dosis</span>
                    <p class="text-lg font-semibold mt-1">{{ $rehabilitation->dosage }} {{ $rehabilitation->unit }}</p>
                </div>
            </div>

            <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-300 block mb-2">Panduan Instruksi:</span>
                <p class="text-sm text-emerald-100 leading-relaxed">{{ $rehabilitation->instructions }}</p>
            </div>
        </div>
    @else
        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-red-800 text-sm">
            Maaf, resep pemulihan hara belum tersedia untuk kombinasi penyakit dan umur ini. Silakan hubungi agronomi kebun.
        </div>
    @endif
</div>
@endsection
