@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Katalog Penyakit & Aturan Rehabilitasi</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar penyakit kelapa sawit dan matriks rekomendasi dosis pemulihan hara berdasarkan umur tanaman.</p>
    </div>

    <div class="space-y-6">
        @foreach($diseases as $disease)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-extrabold text-gray-900">{{ $disease->name }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ $disease->description }}</p>
                    </div>
                </div>
                
                <div class="p-6 bg-gray-50/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="text-xs">
                            <span class="font-bold text-gray-500 uppercase">Gejala Utama:</span>
                            <p class="text-gray-700 mt-1">{{ $disease->symptoms }}</p>
                        </div>
                        <div class="text-xs">
                            <span class="font-bold text-gray-500 uppercase">Saran Pencegahan:</span>
                            <p class="text-gray-700 mt-1">{{ $disease->prevention }}</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs">
                            <thead>
                                <tr class="text-gray-400 font-bold uppercase text-[9px]">
                                    <th class="py-2">Umur Tanaman</th>
                                    <th class="py-2">Jenis Pupuk / Fungisida</th>
                                    <th class="py-2">Dosis</th>
                                    <th class="py-2">Instruksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($disease->rehabilitations as $rehab)
                                    <tr class="text-gray-700">
                                        <td class="py-3 font-semibold">{{ $rehab->ageCategory->label }}</td>
                                        <td class="py-3">{{ $rehab->fertilizer_type }}</td>
                                        <td class="py-3 font-mono font-bold">{{ $rehab->dosage }} {{ $rehab->unit }}</td>
                                        <td class="py-3 text-[11px] leading-relaxed italic text-gray-500">{{ $rehab->instructions }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
