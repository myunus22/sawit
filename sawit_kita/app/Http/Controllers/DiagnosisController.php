<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\AgeCategory;
use App\Models\Rehabilitation;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\Storage;

class DiagnosisController extends Controller
{
    /**
     * Tampilan Halaman Utama / Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_diagnoses' => Diagnosis::count(),
            'ai_count' => Diagnosis::where('method', 'AI')->count(),
            'expert_count' => Diagnosis::where('method', 'Expert System')->count(),
            'diseases_count' => Disease::where('name', '!=', 'Sehat')->count(),
        ];

        $recentDiagnoses = Diagnosis::with(['disease', 'ageCategory'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentDiagnoses'));
    }

    /**
     * Tampilan Kamera AI (AI Diagnosis)
     */
    public function aiForm()
    {
        $diseases = Disease::all();
        $ageCategories = AgeCategory::all();
        return view('diagnose.ai', compact('diseases', 'ageCategories'));
    }

    /**
     * Menyimpan Hasil Diagnosis dari Kamera AI
     */
    public function storeAi(Request $request)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'age_category_id' => 'required|exists:age_categories,id',
            'confidence' => 'required|numeric|min:0|max:100',
            'image_data' => 'nullable|string', // Base64 data from camera
        ]);

        $imagePath = null;
        if ($request->has('image_data') && $request->image_data) {
            // Jika ada data gambar base64, kita simpan secara lokal
            $img = $request->image_data;
            if (str_contains($img, 'data:image')) {
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $fileName = 'ai_' . time() . '.jpg';
                Storage::disk('public')->put('diagnoses/' . $fileName, $data);
                $imagePath = 'storage/diagnoses/' . $fileName;
            }
        }

        $diagnosis = Diagnosis::create([
            'user_id' => auth()->id(),
            'disease_id' => $request->disease_id,
            'age_category_id' => $request->age_category_id,
            'confidence' => $request->confidence,
            'image_path' => $imagePath,
            'method' => 'AI',
            'notes' => 'Dideteksi otomatis melalui visual Kamera AI CNN.',
        ]);

        return response()->json([
            'success' => true,
            'redirect_url' => route('diagnose.show', $diagnosis->id)
        ]);
    }

    /**
     * Tampilan Kuesioner Sistem Pakar (Q&A Diagnosis)
     */
    public function expertForm()
    {
        $ageCategories = AgeCategory::all();
        return view('diagnose.expert', compact('ageCategories'));
    }

    /**
     * Memproses Input Kuesioner Sistem Pakar dan Menyimpan Diagnosis
     */
    public function storeExpert(Request $request)
    {
        $request->validate([
            'age_category_id' => 'required|exists:age_categories,id',
            'symptoms' => 'required|array|min:1',
        ]);

        $selectedSymptoms = $request->symptoms;

        // Logika Evaluasi Sistem Pakar Sederhana (Rule-Based Matching)
        // Kita bandingkan kecocokan gejala dengan bobot kemiripan
        $diseases = Disease::all();
        $bestMatchDiseaseId = null;
        $maxMatchPercentage = 0;
        $notes = [];

        foreach ($diseases as $disease) {
            $matchCount = 0;
            $symptomList = strtolower($disease->symptoms . ' ' . $disease->description);

            foreach ($selectedSymptoms as $symptom) {
                // Cari kata kunci gejala di deskripsi atau gejala penyakit
                if (str_contains($symptomList, strtolower($symptom))) {
                    $matchCount++;
                }
            }

            // Hitung persentase kecocokan
            $totalSelected = count($selectedSymptoms);
            $percentage = $totalSelected > 0 ? ($matchCount / $totalSelected) * 100 : 0;

            if ($percentage > $maxMatchPercentage) {
                $maxMatchPercentage = $percentage;
                $bestMatchDiseaseId = $disease->id;
            }
        }

        // Fallback jika tidak ada kecocokan yang berarti, atau default ke Sehat jika tidak pilih gejala penyakit
        if ($maxMatchPercentage == 0) {
            $sehat = Disease::where('name', 'like', '%Sehat%')->first();
            $bestMatchDiseaseId = $sehat ? $sehat->id : Disease::first()->id;
            $maxMatchPercentage = 100.00;
            $notes[] = "Tidak ada gejala penyakit spesifik yang terdeteksi. Kondisi tanaman diidentifikasi Sehat.";
        } else {
            $matchedDisease = Disease::find($bestMatchDiseaseId);
            $notes[] = "Gejala yang dipilih cocok sebesar " . round($maxMatchPercentage, 1) . "% dengan ciri-ciri penyakit " . $matchedDisease->name . ".";
        }

        $diagnosis = Diagnosis::create([
            'user_id' => auth()->id(),
            'disease_id' => $bestMatchDiseaseId,
            'age_category_id' => $request->age_category_id,
            'confidence' => $maxMatchPercentage,
            'image_path' => null,
            'method' => 'Expert System',
            'notes' => implode(' ', $notes),
        ]);

        return redirect()->route('diagnose.show', $diagnosis->id)
            ->with('success', 'Diagnosis sistem pakar berhasil dihitung!');
    }

    /**
     * Menampilkan Detail Diagnosis dan Resep Pemulihan Hara
     */
    public function show($id)
    {
        $diagnosis = Diagnosis::with(['disease', 'ageCategory'])->findOrFail($id);

        // Cari rekomendasi rehabilitasi yang cocok dengan penyakit dan kategori umur
        $rehabilitation = Rehabilitation::where('disease_id', $diagnosis->disease_id)
            ->where('age_category_id', $diagnosis->age_category_id)
            ->first();

        return view('diagnose.show', compact('diagnosis', 'rehabilitation'));
    }

    /**
     * Menampilkan Riwayat Diagnosis
     */
    public function history()
    {
        $diagnoses = Diagnosis::with(['disease', 'ageCategory'])
            ->latest()
            ->paginate(10);

        return view('diagnose.history', compact('diagnoses'));
    }

    /**
     * Menghapus Riwayat Diagnosis
     */
    public function destroy($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        
        // Hapus file gambar jika ada
        if ($diagnosis->image_path && file_exists(public_path($diagnosis->image_path))) {
            @unlink(public_path($diagnosis->image_path));
        }

        $diagnosis->delete();

        return redirect()->route('diagnose.history')
            ->with('success', 'Riwayat diagnosis berhasil dihapus!');
    }

    /**
     * Tampilan Katalog Penyakit & Aturan Pemupukan
     */
    public function catalog()
    {
        $diseases = Disease::with(['rehabilitations.ageCategory'])->get();
        return view('diseases.catalog', compact('diseases'));
    }
}
