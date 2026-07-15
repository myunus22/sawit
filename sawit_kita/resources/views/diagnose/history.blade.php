@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Riwayat Diagnosis</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar seluruh aktivitas diagnosis yang pernah dilakukan melalui Kamera AI maupun Sistem Pakar.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Penyakit</th>
                        <th class="px-6 py-4">Umur</th>
                        <th class="px-6 py-4 text-center">Confidence</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($diagnoses as $diag)
                        <tr class="hover:bg-emerald-50/30 transition">
                            <td class="px-6 py-4 text-gray-500 font-mono">{{ $diag->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-[9px] font-bold uppercase {{ $diag->method == 'AI' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $diag->method }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $diag->disease->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $diag->ageCategory->label }}</td>
                            <td class="px-6 py-4 text-center text-emerald-700 font-bold font-mono">{{ round($diag->confidence, 1) }}%</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('diagnose.show', $diag->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Detail</a>
                                <form action="{{ route('diagnose.destroy', $diag->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada riwayat diagnosis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $diagnoses->links() }}
        </div>
    </div>
</div>
@endsection
