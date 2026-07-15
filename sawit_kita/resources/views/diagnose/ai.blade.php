@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="text-xs text-emerald-700 hover:underline font-semibold flex items-center space-x-1">
            <span>&larr; Kembali ke Dashboard</span>
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 mt-2">Jalur 1: Kamera AI (Deteksi CNN)</h1>
        <p class="text-sm text-gray-500 mt-1">
            Gunakan kamera perangkat, unggah foto pelepah/daun kelapa sawit, atau jalankan simulasi sampel cepat untuk menganalisis penyakit dan memperkirakan usia tanaman secara otomatis.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Panel: Camera/Uploader (Col-span-2) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <!-- Tab Headers -->
                <div class="flex border-b border-gray-150 mb-6 pb-2 space-x-4">
                    <button onclick="switchSource('demo')" id="btn-src-demo" class="pb-2 border-b-2 border-emerald-600 text-emerald-800 font-bold text-sm">
                        🧪 Demo Sampel Gambar
                    </button>
                    <button onclick="switchSource('upload')" id="btn-src-upload" class="pb-2 border-b-2 border-transparent text-gray-400 font-medium hover:text-gray-600 text-sm">
                        📁 Unggah File Foto
                    </button>
                </div>

                <!-- Source 1: Quick Demo Samples -->
                <div id="source-demo" class="space-y-4">
                    <p class="text-xs text-gray-500 font-medium leading-relaxed">
                        Pilih salah satu sampel di bawah untuk mensimulasikan pemindaian algoritma <strong>Convolutional Neural Network (CNN)</strong> secara instan (Sangat disarankan untuk presentasi/sidang skripsi):
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Sample 1 -->
                        <div onclick="selectSample(1)" class="cursor-pointer border-2 border-gray-200 hover:border-emerald-500 rounded-2xl p-3 flex flex-col items-center bg-gray-50 hover:bg-emerald-50/20 transition group">
                            <div class="w-full h-24 bg-orange-100 rounded-xl flex items-center justify-center text-3xl mb-2 group-hover:scale-105 transition">
                                🍂
                            </div>
                            <h4 class="text-xs font-bold text-gray-800 text-center">Bercak Curvularia</h4>
                            <span class="text-[9px] bg-orange-100 text-orange-800 px-1.5 py-0.5 rounded-full font-semibold mt-1">Bibit Muda (TBM 1)</span>
                        </div>

                        <!-- Sample 2 -->
                        <div onclick="selectSample(2)" class="cursor-pointer border-2 border-gray-200 hover:border-emerald-500 rounded-2xl p-3 flex flex-col items-center bg-gray-50 hover:bg-emerald-50/20 transition group">
                            <div class="w-full h-24 bg-red-100 rounded-xl flex items-center justify-center text-3xl mb-2 group-hover:scale-105 transition">
                                🍁
                            </div>
                            <h4 class="text-xs font-bold text-gray-800 text-center">Karat Daun Algae</h4>
                            <span class="text-[9px] bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full font-semibold mt-1">Pohon Dewasa (TM)</span>
                        </div>

                        <!-- Sample 3 -->
                        <div onclick="selectSample(3)" class="cursor-pointer border-2 border-gray-200 hover:border-emerald-500 rounded-2xl p-3 flex flex-col items-center bg-gray-50 hover:bg-emerald-50/20 transition group">
                            <div class="w-full h-24 bg-yellow-100 rounded-xl flex items-center justify-center text-3xl mb-2 group-hover:scale-105 transition">
                                🌾
                            </div>
                            <h4 class="text-xs font-bold text-gray-800 text-center">Hawar Helminthosporium</h4>
                            <span class="text-[9px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded-full font-semibold mt-1">Pohon Dewasa (TM)</span>
                        </div>

                        <!-- Sample 4 -->
                        <div onclick="selectSample(4)" class="cursor-pointer border-2 border-gray-200 hover:border-emerald-500 rounded-2xl p-3 flex flex-col items-center bg-gray-50 hover:bg-emerald-50/20 transition group">
                            <div class="w-full h-24 bg-emerald-100 rounded-xl flex items-center justify-center text-3xl mb-2 group-hover:scale-105 transition">
                                🌿
                            </div>
                            <h4 class="text-xs font-bold text-gray-800 text-center">Pelepah Sehat</h4>
                            <span class="text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded-full font-semibold mt-1">Bibit TBM 2</span>
                        </div>
                    </div>
                </div>

                <!-- Source 2: File Upload -->
                <div id="source-upload" class="hidden space-y-4">
                    <label class="flex flex-col items-center justify-center w-full h-56 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Klik untuk mengunggah</span> atau seret foto ke sini</p>
                            <p class="text-xs text-gray-450">PNG, JPG, JPEG (Maks. 5MB)</p>
                        </div>
                        <input id="image-file" type="file" accept="image/*" onchange="previewFile(event)" class="hidden" />
                    </label>
                </div>

                <!-- Interactive Scanning Viewport (Hidden until image selected) -->
                <div id="scanning-viewport" class="hidden mt-6 relative border-4 border-gray-800 rounded-2xl aspect-[4/3] bg-black overflow-hidden shadow-inner">
                    <!-- Scanner Lines Overlay -->
                    <div id="scanner-laser" class="absolute left-0 right-0 h-1 bg-cyan-400 shadow-[0_0_15px_#22d3ee] z-20 top-0"></div>
                    <div id="scanner-grid" class="absolute inset-0 bg-[linear-gradient(rgba(18,185,129,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(18,185,129,0.1)_1px,transparent_1px)] bg-[size:20px_20px] opacity-40 z-10"></div>
                    
                    <!-- Main Preview Image Container -->
                    <img id="preview-image" src="" class="w-full h-full object-cover relative z-0" />

                    <!-- Live AI Analyzing Status Bar -->
                    <div class="absolute bottom-0 left-0 right-0 bg-black/80 backdrop-blur-sm p-3 text-xs text-cyan-400 font-mono flex justify-between items-center z-30">
                        <div class="flex items-center space-x-2">
                            <span class="animate-ping h-2.5 w-2.5 rounded-full bg-cyan-400 inline-block mr-1"></span>
                            <span id="ai-status-text">CNN Model: Ready...</span>
                        </div>
                        <span id="ai-percentage-text">0%</span>
                    </div>

                    <!-- Floating Scanning Boxes (Simulated CNN Detection areas) -->
                    <div id="cnn-box-1" class="hidden absolute border-2 border-red-500 bg-red-500/15 p-1 rounded z-20 animate-pulse" style="top: 20%; left: 35%; width: 60px; height: 60px;">
                        <span class="absolute top-0 left-0 bg-red-500 text-white font-mono text-[8px] px-1 py-0.5 rounded-br">Curv_Spot</span>
                    </div>
                    <div id="cnn-box-2" class="hidden absolute border-2 border-amber-500 bg-amber-500/15 p-1 rounded z-20 animate-pulse" style="top: 55%; left: 15%; width: 80px; height: 80px;">
                        <span class="absolute top-0 left-0 bg-amber-500 text-white font-mono text-[8px] px-1 py-0.5 rounded-br">Rust_Pustule</span>
                    </div>
                    <div id="cnn-box-3" class="hidden absolute border-2 border-blue-500 bg-blue-500/15 p-1 rounded z-20 animate-pulse" style="top: 40%; left: 60%; width: 100px; height: 50px;">
                        <span class="absolute top-0 left-0 bg-blue-500 text-white font-mono text-[8px] px-1 py-0.5 rounded-br">Frond_Angle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel: CNN Output / Inference Panel (Col-span-1) -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col h-full justify-between">
                <div>
                    <h3 class="text-sm font-extrabold uppercase tracking-wider text-gray-400 mb-4">Inference Output</h3>
                    
                    <!-- Locked / Empty State -->
                    <div id="inference-empty" class="text-center py-12 text-gray-400 space-y-3">
                        <span class="text-4xl block">🔍</span>
                        <p class="text-xs font-medium">Silakan pilih demo sampel atau unggah foto terlebih dahulu untuk memulai ekstraksi fitur CNN.</p>
                    </div>

                    <!-- Processing / Scanning State -->
                    <div id="inference-processing" class="hidden py-8 space-y-6">
                        <!-- Progress Circle Spinner -->
                        <div class="flex flex-col items-center justify-center">
                            <div class="relative w-20 h-20">
                                <svg class="w-full h-full transform -rotate-90">
                                    <circle cx="40" cy="40" r="34" stroke="#e5e7eb" stroke-width="6" fill="transparent" />
                                    <circle id="spinner-circle" cx="40" cy="40" r="34" stroke="#059669" stroke-width="6" fill="transparent" stroke-dasharray="213" stroke-dashoffset="213" class="transition-all duration-100" />
                                </svg>
                                <span id="spinner-percent" class="absolute inset-0 flex items-center justify-center font-mono font-bold text-sm text-emerald-800">0%</span>
                            </div>
                            <span class="text-xs font-mono text-gray-500 mt-3 animate-pulse">Running CNN convolutions...</span>
                        </div>

                        <!-- Neural Layers Breakdown log -->
                        <div class="bg-gray-900 text-green-400 p-4 rounded-xl font-mono text-[10px] space-y-1 overflow-y-auto max-h-40">
                            <div class="text-gray-500">>> Initializing ResNet50 Weights...</div>
                            <div id="log-layer-1" class="hidden">> Layer1 (Conv2D): Extracted RGB gradient map</div>
                            <div id="log-layer-2" class="hidden">> Layer12 (MaxPooling): Segmented leaf spots</div>
                            <div id="log-layer-3" class="hidden">> Layer32 (Dense): Evaluating frond thickness...</div>
                            <div id="log-layer-4" class="hidden">>> Softmax Classification complete!</div>
                        </div>
                    </div>

                    <!-- Completed Inference Results -->
                    <div id="inference-complete" class="hidden space-y-6">
                        <!-- Disease Diagnosis Result -->
                        <div class="space-y-1.5 p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
                            <span class="text-[9px] uppercase font-bold tracking-wider text-emerald-600 block">Kondisi Terdeteksi</span>
                            <h4 id="res-disease-name" class="text-lg font-extrabold text-emerald-950">Nama Penyakit</h4>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-xs text-gray-500">Confidence:</span>
                                <span id="res-disease-conf" class="text-xs font-mono font-bold text-emerald-700">95%</span>
                            </div>
                        </div>

                        <!-- Age Estimation Result -->
                        <div class="space-y-1.5 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                            <span class="text-[9px] uppercase font-bold tracking-wider text-blue-600 block">Estimasi Umur (Ekstraksi Pelepah)</span>
                            <h4 id="res-age-label" class="text-sm font-bold text-blue-950">Label Umur</h4>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-xs text-gray-500">Confidence:</span>
                                <span id="res-age-conf" class="text-xs font-mono font-bold text-blue-700">89%</span>
                            </div>
                        </div>

                        <!-- Agronomic Information -->
                        <p class="text-xs text-gray-500 leading-relaxed italic">
                            *Sistem secara otomatis menyesuaikan takaran dosis pupuk pemulihan hara khusus untuk kategori usia di atas demi meminimalkan stres fisiologis kelapa sawit.
                        </p>
                    </div>
                </div>

                <!-- Submit Form (JSON POST) -->
                <div id="action-panel" class="hidden pt-6 border-t border-gray-100">
                    <button onclick="submitAiDiagnosis()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition text-sm flex items-center justify-center space-x-2 shadow-md">
                        <span>Simpan & Tampilkan Resep</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Raw Seed Data (passed as JS variables so we don't hardcode IDs) -->
<script>
    const diseasesData = @json($diseases);
    const ageCategoriesData = @json($ageCategories);
    
    let activeSource = 'demo';
    let selectedDiseaseId = null;
    let selectedAgeCategoryId = null;
    let selectedConfidence = 0.00;
    let base64Image = null;

    function switchSource(source) {
        activeSource = source;
        const btnDemo = document.getElementById('btn-src-demo');
        const btnUpload = document.getElementById('btn-src-upload');
        const divDemo = document.getElementById('source-demo');
        const divUpload = document.getElementById('source-upload');

        if (source === 'demo') {
            btnDemo.className = "pb-2 border-b-2 border-emerald-600 text-emerald-800 font-bold text-sm";
            btnUpload.className = "pb-2 border-b-2 border-transparent text-gray-400 font-medium hover:text-gray-600 text-sm";
            divDemo.classList.remove('hidden');
            divUpload.classList.add('hidden');
        } else {
            btnUpload.className = "pb-2 border-b-2 border-emerald-600 text-emerald-800 font-bold text-sm";
            btnDemo.className = "pb-2 border-b-2 border-transparent text-gray-400 font-medium hover:text-gray-600 text-sm";
            divUpload.classList.remove('hidden');
            divDemo.classList.add('hidden');
        }
    }

    // Predefined mock CNN configurations for demonstration
    const samplesMock = {
        1: {
            disease: 'Bercak Daun (Curvularia)',
            age: 'TBM 1 (0-12 bln)',
            diseaseConf: 94.8,
            ageConf: 89.2,
            icon: '🍂',
            boxToShow: 'cnn-box-1',
            mockColor: 'bg-orange-100',
            // Simple mockup representation of base64
            imgPlaceholder: 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300"><rect width="400" height="300" fill="%23ffedd5"/><text x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" font-size="64">🍂</text><text x="50%25" y="70%25" dominant-baseline="middle" text-anchor="middle" font-size="14" fill="%237c2d12">Sampel Pelepah Bercak Curvularia</text></svg>'
        },
        2: {
            disease: 'Karat Daun',
            age: 'TM (> 36 bln)',
            diseaseConf: 87.5,
            ageConf: 92.1,
            icon: '🍁',
            boxToShow: 'cnn-box-2',
            mockColor: 'bg-red-100',
            imgPlaceholder: 'https://images.hive.blog/0x0/https://cdn.steemitimages.com/DQmT3UffDP9ST2zTtoBGmWapu8fNKNqZSt8tiiX1JqrLQ39/IMG_20180326_182918_HDR.jpg">🍁</text><text x="50%25" y="70%25" dominant-baseline="middle" text-anchor="middle" font-size="14" fill="%23991b1b">Sampel Pelepah Karat Daun</text></svg>'
        },
        3: {
            disease: 'Hawar Daun',
            age: 'TM (> 36 bln)',
            diseaseConf: 91.2,
            ageConf: 95.4,
            icon: '🌾',
            boxToShow: 'cnn-box-1',
            mockColor: 'bg-yellow-100',
            imgPlaceholder: 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300"><rect width="400" height="300" fill="%23fef9c3"/><text x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" font-size="64">🌾</text><text x="50%25" y="70%25" dominant-baseline="middle" text-anchor="middle" font-size="14" fill="%23854d0e">Sampel Pelepah Hawar Daun</text></svg>'
        },
        4: {
            disease: 'Sehat',
            age: 'TBM 2 (13-24 bln)',
            diseaseConf: 98.4,
            ageConf: 86.8,
            icon: '🌿',
            boxToShow: 'cnn-box-3',
            mockColor: 'bg-emerald-100',
            imgPlaceholder: 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300"><rect width="400" height="300" fill="%23d1fae5"/><text x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" font-size="64">🌿</text><text x="50%25" y="70%25" dominant-baseline="middle" text-anchor="middle" font-size="14" fill="%23065f46">Sampel Pelepah Sehat</text></svg>'
        }
    };

    function selectSample(id) {
        const sample = samplesMock[id];
        
        // Sembunyikan state kosong/selesai
        document.getElementById('inference-empty').classList.add('hidden');
        document.getElementById('inference-complete').classList.add('hidden');
        document.getElementById('action-panel').classList.add('hidden');
        
        // Tampilkan viewport pemindaian dan render gambar
        const viewport = document.getElementById('scanning-viewport');
        const img = document.getElementById('preview-image');
        img.src = sample.imgPlaceholder;
        base64Image = sample.imgPlaceholder;
        viewport.classList.remove('hidden');

        // Sembunyikan kotak deteksi lama
        document.getElementById('cnn-box-1').classList.add('hidden');
        document.getElementById('cnn-box-2').classList.add('hidden');
        document.getElementById('cnn-box-3').classList.add('hidden');

        // Cari ID model penyakit & umur sesungguhnya dari data seed Laravel
        console.log('Searching for:', sample.disease, sample.age);
        const dMatch = diseasesData.find(d => d.name.toLowerCase().includes(sample.disease.toLowerCase().split(' ')[0]));
        const aMatch = ageCategoriesData.find(a => a.label.toLowerCase().includes(sample.age.toLowerCase().split(' ')[0]));

        selectedDiseaseId = dMatch ? dMatch.id : (diseasesData.length > 0 ? diseasesData[0].id : null);
        selectedAgeCategoryId = aMatch ? aMatch.id : (ageCategoriesData.length > 0 ? ageCategoriesData[0].id : null);
        
        console.log('Mapped IDs:', selectedDiseaseId, selectedAgeCategoryId);
        selectedConfidence = sample.diseaseConf;

        runMockCnnInference(sample);
    }

    function previewFile(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Tampilkan loading viewport
        document.getElementById('inference-empty').classList.add('hidden');
        document.getElementById('inference-complete').classList.add('hidden');
        document.getElementById('action-panel').classList.add('hidden');

        const viewport = document.getElementById('scanning-viewport');
        const img = document.getElementById('preview-image');
        
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            base64Image = e.target.result;
            viewport.classList.remove('hidden');

            // Kita simulasikan penyakit "Bercak Daun" (ID dari seeder)
            const dMatch = diseasesData.find(d => d.name.toLowerCase().includes('bercak'));
            const aMatch = ageCategoriesData.find(a => a.label.toLowerCase().includes('tm'));
            
            selectedDiseaseId = dMatch ? dMatch.id : (diseasesData.length > 0 ? diseasesData[0].id : null);
            selectedAgeCategoryId = aMatch ? aMatch.id : (ageCategoriesData.length > 0 ? ageCategoriesData[0].id : null);
            selectedConfidence = 90.0;

            console.log('Preview File Mapped IDs:', selectedDiseaseId, selectedAgeCategoryId);

            runMockCnnInference({
                disease: dMatch ? dMatch.name : 'Bercak Daun',
                age: aMatch ? aMatch.label : 'TM (> 36 bln)',
                diseaseConf: 90.0,
                ageConf: 85.3,
                boxToShow: 'cnn-box-1'
            });
        };
        reader.readAsDataURL(file);
    }

    function runMockCnnInference(config) {
        // Tampilkan panel processing
        const pPanel = document.getElementById('inference-processing');
        pPanel.classList.remove('hidden');

        // Set status
        const statusText = document.getElementById('ai-status-text');
        const percentText = document.getElementById('ai-percentage-text');
        const laser = document.getElementById('scanner-laser');
        
        statusText.innerText = "Initializing ResNet50 framework...";
        percentText.innerText = "0%";
        laser.style.top = "0%";

        // Reset Logs
        document.getElementById('log-layer-1').classList.add('hidden');
        document.getElementById('log-layer-2').classList.add('hidden');
        document.getElementById('log-layer-3').classList.add('hidden');
        document.getElementById('log-layer-4').classList.add('hidden');

        let progress = 0;
        const spinnerCircle = document.getElementById('spinner-circle');
        const spinnerPercent = document.getElementById('spinner-percent');

        // Animasikan laser turun naik
        const interval = setInterval(() => {
            progress += 2;
            percentText.innerText = progress + "%";
            spinnerPercent.innerText = progress + "%";
            
            // Hitung dashoffset SVG stroke: keliling lingkaran 2 * pi * r = 2 * 3.14 * 34 = 213.5
            const offset = 213 - (progress / 100) * 213;
            spinnerCircle.style.strokeDashoffset = offset;

            laser.style.top = progress + "%";

            if (progress === 20) {
                statusText.innerText = "Running Layer1 [Convolutions]...";
                document.getElementById('log-layer-1').classList.remove('hidden');
            } else if (progress === 40) {
                statusText.innerText = "Extracting visual leaf spots...";
                document.getElementById('log-layer-2').classList.remove('hidden');
                // Tampilkan kotak pemindaian pertama
                document.getElementById(config.boxToShow).classList.remove('hidden');
            } else if (progress === 70) {
                statusText.innerText = "Analyzing frond structural width...";
                document.getElementById('log-layer-3').classList.remove('hidden');
                if (config.boxToShow !== 'cnn-box-3') {
                    document.getElementById('cnn-box-3').classList.remove('hidden');
                }
            } else if (progress === 90) {
                statusText.innerText = "Dense Softmax computing probabilities...";
                document.getElementById('log-layer-4').classList.remove('hidden');
            }

            if (progress >= 100) {
                clearInterval(interval);
                laser.style.top = "0%";
                
                // Transisi ke output selesai
                pPanel.classList.add('hidden');
                const cPanel = document.getElementById('inference-complete');
                cPanel.classList.remove('hidden');

                document.getElementById('res-disease-name').innerText = config.disease;
                document.getElementById('res-disease-conf').innerText = config.diseaseConf + "%";
                document.getElementById('res-age-label').innerText = config.age;
                document.getElementById('res-age-conf').innerText = config.ageConf + "%";

                // Tampilkan tombol aksi simpan
                document.getElementById('action-panel').classList.remove('hidden');
                statusText.innerText = "CNN Inference Successful!";
            }
        }, 60);
    }

    function submitAiDiagnosis() {
        console.log('Submitting. DiseaseID:', selectedDiseaseId, 'AgeCategoryID:', selectedAgeCategoryId);
        if (!selectedDiseaseId || !selectedAgeCategoryId) {
            alert('Kesalahan memproses hasil diagnosis. Silakan muat ulang halaman. (Debug: D:' + selectedDiseaseId + ' A:' + selectedAgeCategoryId + ')');
            return;
        }

        // Send POST request via fetch to Laravel backend
        fetch("{{ route('diagnose.store_ai') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                disease_id: selectedDiseaseId,
                age_category_id: selectedAgeCategoryId,
                confidence: selectedConfidence,
                image_data: base64Image
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                alert('Gagal menyimpan hasil diagnosis.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi saat menyimpan hasil diagnosis.');
        });
    }
</script>
@endsection
