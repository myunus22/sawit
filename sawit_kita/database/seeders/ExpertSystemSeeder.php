<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;
use App\Models\AgeCategory;
use App\Models\Rehabilitation;

class ExpertSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Diseases
        $diseases = [
            [
                'name' => 'Bercak Daun (Curvularia)',
                'description' => 'Penyakit bercak daun disebabkan oleh infeksi jamur Curvularia maculans. Penyakit ini menyerang bagian pelepah dan daun kelapa sawit pada semua fase umur, terutama pada masa pembibitan (pre-nursery dan main nursery) hingga tanaman menghasilkan (TM). Gangguan fotosintesis akibat kerusakan klorofil menurunkan laju pertumbuhan tanaman secara signifikan.',
                'symptoms' => 'Bercak kecil berbentuk bulat atau oval berwarna coklat tua berukuran 1-2 mm. Lambat laun bercak membesar dengan bagian pusat berwarna coklat muda/abu-abu kering dengan pinggiran berwarna kuning tua keemasan yang membentuk lingkaran halo.',
                'prevention' => 'Mengatur jarak antar bibit di pembibitan untuk sirkulasi udara optimal, mengurangi kelembaban tinggi dengan sistem penyiraman teratur, memotong dan membakar pelepah daun yang terinfeksi berat, serta melakukan penyemprotan fungisida berbahan aktif mankozeb atau captan secara berkala.'
            ],
            [
                'name' => 'Karat Daun',
                'description' => 'Penyakit karat daun pada kelapa sawit umumnya disebabkan oleh aktivitas ganggang parasit Cephaleuros virescens. Ganggang ini mengolonisasi permukaan luar epidermis daun kelapa sawit pada kondisi kelembaban udara yang sangat tinggi dan paparan sinar matahari yang kurang memadai akibat tajuk pohon yang terlalu rapat.',
                'symptoms' => 'Munculnya bercak-bercak berwarna jingga kemerahan atau oranye terang pada permukaan atas daun. Bercak tersebut terasa kasar saat disentuh, mirip dengan lapisan beludru halus karena merupakan struktur filamen ganggang.',
                'prevention' => 'Melakukan pemangkasan pelepah (pruning) secara teratur untuk mengoptimalkan intensitas penetrasi cahaya matahari ke daun bagian bawah, menjaga sistem drainase lahan agar tidak tergenang, serta mengaplikasikan fungisida tembaga (copper hydroxide) apabila intensitas infeksi di lapangan melebihi ambang batas.'
            ],
            [
                'name' => 'Hawar Daun',
                'description' => 'Hawar daun disebabkan oleh patogen jamur Helminthosporium sp. Penyakit ini bersifat agresif dan dapat menyebar dengan cepat melalui spora yang terbawa angin atau percikan air hujan. Jika dibiarkan, daun kelapa sawit akan mengering seperti terbakar dan rontok (defoliasi), menghambat pasokan energi fotosintesis tanaman.',
                'symptoms' => 'Bercak memanjang berwarna coklat keabu-abuan atau coklat basah. Bercak ini dengan cepat melebar sepanjang urat daun membentuk pola hawar yang luas. Ujung daun tampak mengering, mengerut, dan rapuh berwarna coklat tua dengan batas tepi luar berwarna kuning terang.',
                'prevention' => 'Aplikasi pemupukan unsur hara Kalium (K) yang seimbang untuk memperkuat dinding sel daun dari penetrasi hifa jamur, menjaga kebersihan piringan tanaman dari gulma pembawa inang patogen, serta melakukan penyemprotan fungisida sistemik berbahan aktif triazol secara merata.'
            ],
            [
                'name' => 'Sehat',
                'description' => 'Tanaman kelapa sawit dalam kondisi normal, tumbuh dengan optimal, dan terbebas dari serangan patogen jamur maupun ganggang parasit. Tanaman sehat memiliki kemampuan fotosintesis yang sempurna untuk mendukung pembentukan Tandan Buah Segar (TBS) yang berkualitas.',
                'symptoms' => 'Daun berwarna hijau segar mengkilap tanpa adanya bercak nekrotik, pelepah tegak lurus dengan sudut optimal, dan tidak ada tanda-tanda kerusakan fisik yang disebabkan oleh serangan mikroorganisme pengganggu.',
                'prevention' => 'Melakukan perawatan rutin berupa pembersihan piringan (weed control), pemupukan makro (Urea, TSP, MOP/KCI) dan mikro (Boron) yang terjadwal secara presisi berdasarkan tabel rekomendasi hara tanaman sawit.'
            ],
        ];

        foreach ($diseases as $d) {
            Disease::create($d);
        }

        // 2. Seed Age Categories
        $ages = [
            ['label' => 'TBM 1 (0-12 bln)', 'min_age_months' => 0, 'max_age_months' => 12],
            ['label' => 'TBM 2 (13-24 bln)', 'min_age_months' => 13, 'max_age_months' => 24],
            ['label' => 'TBM 3 (25-36 bln)', 'min_age_months' => 25, 'max_age_months' => 36],
            ['label' => 'TM (> 36 bln)', 'min_age_months' => 37, 'max_age_months' => 600],
        ];

        foreach ($ages as $a) {
            AgeCategory::create($a);
        }

        // 3. Seed Rehabilitations (Completing the full matrix of 4 Diseases x 4 Age Categories)
        $diseaseIds = Disease::all()->pluck('id', 'name');
        $ageIds = AgeCategory::all()->pluck('id', 'label');

        $rehabMatrix = [
            // Bercak Daun (Curvularia)
            [
                'disease' => 'Bercak Daun (Curvularia)',
                'age' => 'TBM 1 (0-12 bln)',
                'fertilizer' => 'Pupuk NPK 15-15-15 + Fungisida Mankozeb',
                'dosage' => 0.25,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk NPK secara merata pada daerah piringan bibit kelapa sawit sejauh 15 cm dari pangkal batang. Lakukan penyemprotan fungisida Mankozeb dengan konsentrasi 2 gram/liter air pada seluruh helai daun seminggu sekali di pagi hari.'
            ],
            [
                'disease' => 'Bercak Daun (Curvularia)',
                'age' => 'TBM 2 (13-24 bln)',
                'fertilizer' => 'Pupuk NPK 15-15-15 + Fungisida Mankozeb',
                'dosage' => 0.50,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk NPK melingkar di sekeliling piringan berjarak 30 cm dari batang utama. Lakukan penyemprotan fungisida Mankozeb dosis 2,5 gram/liter air secara merata pada pelepah bagian bawah yang rentan jamur.'
            ],
            [
                'disease' => 'Bercak Daun (Curvularia)',
                'age' => 'TBM 3 (25-36 bln)',
                'fertilizer' => 'Pupuk NPK 12-12-17-2 + Fungisida Mankozeb',
                'dosage' => 1.00,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk NPK pada radius 50 cm dari batang kelapa sawit pada tanah yang bersih dari gulma. Semprotkan fungisida kontak Mankozeb dengan interval 10 hari sekali pada pelepah-pelepah muda.'
            ],
            [
                'disease' => 'Bercak Daun (Curvularia)',
                'age' => 'TM (> 36 bln)',
                'fertilizer' => 'Pupuk NPK 12-12-17-2 + Fungisida Sistemik',
                'dosage' => 2.50,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk NPK secara melingkar di daerah luar piringan (tajuk terluar pelepah) sejauh 1,5 - 2 meter dari batang pohon. Lakukan fogging/penyemprotan daun menggunakan fungisida sistemik berbahan aktif triazol jika serangan mencapai tingkat keparahan tinggi.'
            ],

            // Karat Daun
            [
                'disease' => 'Karat Daun',
                'age' => 'TBM 1 (0-12 bln)',
                'fertilizer' => 'Pupuk Kieserit (Magnesium) + Fungisida Tembaga',
                'dosage' => 0.15,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan Kieserit tipis di piringan pembibitan. Semprotkan fungisida berbahan aktif tembaga hidroksida (Cu(OH)2) dengan dosis rendah (1,5 gram/liter air) untuk mematikan koloni ganggang parasit.'
            ],
            [
                'disease' => 'Karat Daun',
                'age' => 'TBM 2 (13-24 bln)',
                'fertilizer' => 'Pupuk Kieserit (Magnesium) + Fungisida Tembaga',
                'dosage' => 0.30,
                'unit' => 'kg/pohon',
                'instructions' => 'Aplikasikan Kieserit secara merata melingkari pangkal bibit. Lakukan pruning ringan pada daun terbawah yang menyentuh tanah dan semprot fungisida tembaga hidroksida secara fokus pada bagian bercak beludru.'
            ],
            [
                'disease' => 'Karat Daun',
                'age' => 'TBM 3 (25-36 bln)',
                'fertilizer' => 'Pupuk NPK + Kieserit + Fungisida Tembaga',
                'dosage' => 0.60,
                'unit' => 'kg/pohon',
                'instructions' => 'Campurkan Kieserit dengan NPK, taburkan merata di piringan pohon. Semprotkan fungisida tembaga dengan dosis 2 gram/liter air pada tajuk pelepah tengah ke bawah yang kurang terkena matahari.'
            ],
            [
                'disease' => 'Karat Daun',
                'age' => 'TM (> 36 bln)',
                'fertilizer' => 'Pupuk NPK 12-12-17-2 + Kieserit (Magnesium)',
                'dosage' => 1.20,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan campuran NPK dan Kieserit di sekeliling tajuk terluar pohon sawit. Lakukan penjarangan gulma berdaun lebar di sekitar pokok sawit untuk mengurangi kelembaban mikro lahan secara optimal.'
            ],

            // Hawar Daun
            [
                'disease' => 'Hawar Daun',
                'age' => 'TBM 1 (0-12 bln)',
                'fertilizer' => 'Pupuk MOP / KCI (Kalium) + Fungisida Triazol',
                'dosage' => 0.20,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk MOP (KCI) di sekeliling pangkal bibit guna mempertebal dinding sel pelepah sawit agar lebih tahan serangan hifa jamur. Semprotkan fungisida sistemik golongan triazol dosis 1,5 ml/liter air.'
            ],
            [
                'disease' => 'Hawar Daun',
                'age' => 'TBM 2 (13-24 bln)',
                'fertilizer' => 'Pupuk MOP / KCI (Kalium) + Fungisida Triazol',
                'dosage' => 0.40,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk KCI secara merata melingkar berjarak 25 cm dari pangkal batang. Lakukan isolasi bibit yang terinfeksi hawar daun agar spora jamur Helminthosporium tidak terbawa angin ke barisan bibit sehat.'
            ],
            [
                'disease' => 'Hawar Daun',
                'age' => 'TBM 3 (25-36 bln)',
                'fertilizer' => 'Pupuk NPK Tinggi K + Fungisida Triazol',
                'dosage' => 0.80,
                'unit' => 'kg/pohon',
                'instructions' => 'Berikan pupuk NPK yang kaya kandungan Kalium di piringan kelapa sawit. Lakukan penyemprotan fungisida sistemik triazol dosis 2 ml/liter air secara merata terutama setelah hujan reda.'
            ],
            [
                'disease' => 'Hawar Daun',
                'age' => 'TM (> 36 bln)',
                'fertilizer' => 'Pupuk NPK Tinggi K (NPK 12-12-17-2) + Fungisida Sistemik',
                'dosage' => 1.80,
                'unit' => 'kg/pohon',
                'instructions' => 'Taburkan pupuk NPK tinggi Kalium di sepanjang area piringan kelapa sawit dewasa. Potong pelepah-pelepah kering yang terkena dampak hawar daun agar infeksi tidak menjalar, lalu musnahkan pelepah pangkasan tersebut.'
            ],

            // Sehat
            [
                'disease' => 'Sehat',
                'age' => 'TBM 1 (0-12 bln)',
                'fertilizer' => 'Pupuk NPK Pemeliharaan 15-15-15',
                'dosage' => 0.10,
                'unit' => 'kg/pohon',
                'instructions' => 'Lakukan pemupukan pemeliharaan rutin sebulan sekali secara melingkar di sekeliling bibit sawit. Jaga tingkat kelembaban piringan serta lakukan penyiraman pagi dan sore secara teratur.'
            ],
            [
                'disease' => 'Sehat',
                'age' => 'TBM 2 (13-24 bln)',
                'fertilizer' => 'Pupuk NPK Pemeliharaan 15-15-15',
                'dosage' => 0.25,
                'unit' => 'kg/pohon',
                'instructions' => 'Berikan pupuk NPK pemeliharaan secara rutin setiap 3 bulan sekali. Lakukan monitoring sanitasi piringan sawit dari tumbuhnya gulma kompetitor nutrisi hara.'
            ],
            [
                'disease' => 'Sehat',
                'age' => 'TBM 3 (25-36 bln)',
                'fertilizer' => 'Pupuk NPK Pemeliharaan 15-15-15',
                'dosage' => 0.50,
                'unit' => 'kg/pohon',
                'instructions' => 'Terapkan pupuk NPK pemeliharaan secara merata di sekeliling tajuk kelapa sawit muda untuk mempersiapkan transisi fase pertumbuhan vegetatif menuju fase generatif pembungaan.'
            ],
            [
                'disease' => 'Sehat',
                'age' => 'TM (> 36 bln)',
                'fertilizer' => 'Pupuk NPK Produksi 16-16-16 + Borat',
                'dosage' => 2.00,
                'unit' => 'kg/pohon',
                'instructions' => 'Berikan pupuk NPK produksi tinggi secara seimbang di piringan luar kelapa sawit dewasa untuk memaksimalkan bobot dan jumlah Tandan Buah Segar (TBS). Berikan juga unsur Boron (Borate) sekitar 50 gram per pokok.'
            ],
        ];

        foreach ($rehabMatrix as $r) {
            if (isset($diseaseIds[$r['disease']]) && isset($ageIds[$r['age']])) {
                Rehabilitation::create([
                    'disease_id' => $diseaseIds[$r['disease']],
                    'age_category_id' => $ageIds[$r['age']],
                    'fertilizer_type' => $r['fertilizer'],
                    'dosage' => $r['dosage'],
                    'unit' => $r['unit'],
                    'instructions' => $r['instructions'],
                ]);
            }
        }
    }
}
