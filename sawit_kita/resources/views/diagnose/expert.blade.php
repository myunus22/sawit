@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="text-xs text-emerald-700 hover:underline font-semibold flex items-center space-x-1">
            <span>&larr; Kembali ke Dashboard</span>
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 mt-2">Jalur 2: Tanya Jawab Sistem Pakar</h1>
        <p class="text-sm text-gray-500 mt-1">
            Pilih gejala yang terlihat pada pelepah kelapa sawit Anda. Sistem akan menganalisis berdasarkan aturan pakar untuk menentukan penyakit dan dosis rehabilitasi hara.
        </p>
    </div>

    <form action="{{ route('diagnose.store_expert') }}" method="POST" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        @csrf
        
        <!-- Age Selection -->
        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-3">1. Berapakah Estimasi Usia Kelapa Sawit?</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($ageCategories as $age)
                    <label class="cursor-pointer">
                        <input type="radio" name="age_category_id" value="{{ $age->id }}" class="peer hidden" required>
                        <div class="p-4 border-2 border-gray-200 rounded-2xl peer-checked:border-emerald-600 peer-checked:bg-emerald-50 transition">
                            <span class="text-sm font-semibold text-gray-800">{{ $age->label }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Symptoms Selection -->
        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-3">2. Pilih Gejala yang Teramati (Centang semua yang sesuai):</label>
            <div class="space-y-3">
                @php
                    $symptomsList = [
                        'Bercak kecil', 'Bentuk bulat', 'Bentuk oval', 'Coklat tua', 'Coklat muda', 'Pusat abu-abu', 
                        'Pinggiran kuning', 'Oranye terang', 'T terasa kasar', 'Beludru', 'Bercak memanjang', 
                        'Daun mengering', 'Tepi daun kuning'
                    ];
                @endphp
                <div class="grid grid-cols-2 gap-3">
                    @foreach($symptomsList as $symptom)
                        <label class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition">
                            <input type="checkbox" name="symptoms[]" value="{{ $symptom }}" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">{{ $symptom }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-md transition text-sm flex items-center justify-center space-x-2">
            <span>Analisis Diagnosis Pakar</span>
            <span>&rarr;</span>
        </button>
    </form>
</div>
@endsection
