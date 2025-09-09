<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $author = User::first(); // Get first user as author

        if (!$author) {
            throw new \Exception('No users found. Please run UserSeeder first.');
        }

        $newsArticles = [
            [
                'title' => 'Peluncuran Program Digitalisasi PUPR 2025',
                'slug' => 'peluncuran-program-digitalisasi-pupr-2025',
                'excerpt' => 'Kementerian PUPR meluncurkan program digitalisasi infrastruktur untuk meningkatkan efisiensi pembangunan nasional.',
                'content' => '<p>Jakarta - Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR) resmi meluncurkan program digitalisasi infrastruktur 2025 yang bertujuan untuk meningkatkan efisiensi dan transparansi dalam pembangunan infrastruktur nasional.</p><p>Program ini mencakup implementasi teknologi Building Information Modeling (BIM), Internet of Things (IoT), dan Artificial Intelligence (AI) dalam proses perencanaan, pembangunan, dan pemeliharaan infrastruktur.</p><p>Menteri PUPR menyatakan bahwa program ini akan menghemat biaya pembangunan hingga 20% dan mempercepat penyelesaian proyek hingga 30%.</p>',
                'category_id' => $categories->where('slug', 'berita-utama')->first()?->id ?? 1,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(1),
                'tags' => ['digitalisasi', 'teknologi', 'infrastruktur', 'BIM', 'IoT'],
                'meta_data' => [
                    'meta_title' => 'Program Digitalisasi PUPR 2025 - Revolusi Infrastruktur Digital',
                    'meta_description' => 'Kementerian PUPR luncurkan program digitalisasi untuk efisiensi pembangunan infrastruktur nasional dengan teknologi BIM, IoT, dan AI.',
                    'keywords' => 'digitalisasi, PUPR, infrastruktur, BIM, teknologi'
                ],
            ],
            [
                'title' => 'Pengumuman Lelang Pembangunan Jalan Tol Trans Sumatera Tahap 3',
                'slug' => 'pengumuman-lelang-jalan-tol-trans-sumatera-tahap-3',
                'excerpt' => 'Kementerian PUPR mengumumkan pembukaan lelang untuk pembangunan Jalan Tol Trans Sumatera Tahap 3 sepanjang 150 km.',
                'content' => '<p>Palembang - Kementerian PUPR mengumumkan pembukaan lelang terbuka untuk pembangunan Jalan Tol Trans Sumatera Tahap 3 yang menghubungkan Palembang-Bengkulu sepanjang 150 kilometer.</p><p>Proyek senilai Rp 25 triliun ini diharapkan dapat meningkatkan konektivitas antar wilayah di Sumatera dan mendorong pertumbuhan ekonomi regional.</p><p>Pendaftaran lelang dibuka mulai 15 September 2025 dengan syarat kontraktor harus memiliki sertifikat kualifikasi grade 7 dan pengalaman minimal 5 tahun dalam pembangunan jalan tol.</p>',
                'category_id' => $categories->where('slug', 'pengumuman')->first()?->id ?? 2,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(2),
                'tags' => ['lelang', 'jalan tol', 'trans sumatera', 'infrastruktur'],
                'meta_data' => [
                    'meta_title' => 'Lelang Jalan Tol Trans Sumatera Tahap 3 - PUPR',
                    'meta_description' => 'Pengumuman lelang pembangunan Jalan Tol Trans Sumatera Tahap 3 Palembang-Bengkulu sepanjang 150 km senilai Rp 25 triliun.',
                ],
            ],
            [
                'title' => 'Workshop Teknologi Green Building untuk Masa Depan Berkelanjutan',
                'slug' => 'workshop-teknologi-green-building-berkelanjutan',
                'excerpt' => 'PUPR mengadakan workshop nasional tentang teknologi green building untuk mendorong pembangunan berkelanjutan.',
                'content' => '<p>Jakarta - Balai Penelitian dan Pengembangan Kementerian PUPR menggelar workshop nasional tentang teknologi green building yang dihadiri oleh 200 peserta dari berbagai daerah.</p><p>Workshop ini membahas implementasi teknologi ramah lingkungan dalam pembangunan gedung, termasuk sistem manajemen energi, penggunaan material lokal, dan desain berkelanjutan.</p><p>Diharapkan melalui workshop ini, para arsitek dan kontraktor dapat mengadopsi teknologi green building dalam setiap proyek pembangunan.</p>',
                'category_id' => $categories->where('slug', 'kegiatan')->first()?->id ?? 3,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(3),
                'tags' => ['workshop', 'green building', 'berkelanjutan', 'lingkungan'],
            ],
            [
                'title' => 'PUPR Raih Penghargaan Best Innovation Award 2025',
                'slug' => 'pupr-raih-penghargaan-best-innovation-award-2025',
                'excerpt' => 'Kementerian PUPR meraih penghargaan Best Innovation Award 2025 untuk inovasi sistem monitoring jembatan otomatis.',
                'content' => '<p>Geneva - Kementerian PUPR meraih penghargaan Best Innovation Award 2025 dari World Infrastructure Organization untuk inovasi sistem monitoring jembatan otomatis berbasis IoT.</p><p>Sistem ini dapat memantau kondisi struktur jembatan secara real-time dan memberikan peringatan dini jika terjadi kerusakan atau deformasi.</p><p>Penghargaan ini membuktikan komitmen PUPR dalam mengembangkan teknologi inovatif untuk keselamatan infrastruktur nasional.</p>',
                'category_id' => $categories->where('slug', 'prestasi')->first()?->id ?? 4,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(4),
                'tags' => ['penghargaan', 'inovasi', 'monitoring', 'jembatan', 'IoT'],
            ],
            [
                'title' => 'Implementasi AI dalam Perencanaan Tata Kota Cerdas',
                'slug' => 'implementasi-ai-perencanaan-tata-kota-cerdas',
                'excerpt' => 'PUPR mulai mengimplementasikan teknologi Artificial Intelligence untuk perencanaan tata kota yang lebih efisien dan berkelanjutan.',
                'content' => '<p>Surabaya - Kementerian PUPR bekerjasama dengan Institut Teknologi Sepuluh Nopember (ITS) memulai pilot project implementasi Artificial Intelligence (AI) dalam perencanaan tata kota cerdas di Surabaya.</p><p>Teknologi AI ini akan membantu menganalisis pola lalu lintas, kepadatan penduduk, dan kebutuhan infrastruktur untuk mengoptimalkan perencanaan kota.</p><p>Proyek ini diharapkan dapat menjadi model untuk diterapkan di kota-kota besar lainnya di Indonesia.</p>',
                'category_id' => $categories->where('slug', 'teknologi')->first()?->id ?? 5,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
                'tags' => ['AI', 'artificial intelligence', 'smart city', 'perencanaan kota'],
            ],
            [
                'title' => 'Program Sertifikasi Tenaga Kerja Konstruksi Digital',
                'slug' => 'program-sertifikasi-tenaga-kerja-konstruksi-digital',
                'excerpt' => 'PUPR meluncurkan program sertifikasi khusus untuk tenaga kerja konstruksi dalam era digital.',
                'content' => '<p>Bandung - Badan Pengembangan Sumber Daya Manusia (BPSDM) PUPR meluncurkan program sertifikasi tenaga kerja konstruksi digital yang mencakup kompetensi BIM, project management software, dan teknologi konstruksi modern.</p><p>Program ini ditargetkan untuk melatih 10,000 tenaga kerja konstruksi dalam 2 tahun ke depan.</p><p>Sertifikasi ini akan menjadi standar baru untuk tenaga kerja konstruksi yang ingin bekerja pada proyek-proyek infrastruktur modern.</p>',
                'category_id' => $categories->where('slug', 'program')->first()?->id ?? 6,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(6),
                'tags' => ['sertifikasi', 'tenaga kerja', 'konstruksi digital', 'BIM'],
            ],
            [
                'title' => 'Kerjasama dengan Jepang untuk Transfer Teknologi Infrastruktur',
                'slug' => 'kerjasama-jepang-transfer-teknologi-infrastruktur',
                'excerpt' => 'PUPR menandatangani MoU dengan Kementerian Infrastruktur Jepang untuk transfer teknologi konstruksi tahan gempa.',
                'content' => '<p>Tokyo - Menteri PUPR menandatangani Memorandum of Understanding (MoU) dengan Kementerian Infrastruktur, Transport, dan Pariwisata Jepang untuk transfer teknologi konstruksi tahan gempa.</p><p>Kerjasama ini mencakup pelatihan teknis, pertukaran ahli, dan implementasi teknologi isolator gempa pada bangunan vital di Indonesia.</p><p>Program ini akan dimulai dengan pilot project pada 10 rumah sakit di zona rawan gempa.</p>',
                'category_id' => $categories->where('slug', 'kerjasama')->first()?->id ?? 7,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(7),
                'tags' => ['kerjasama', 'jepang', 'teknologi', 'tahan gempa'],
            ],
            [
                'title' => 'Pelatihan Manajemen Proyek Infrastruktur untuk Pemerintah Daerah',
                'slug' => 'pelatihan-manajemen-proyek-infrastruktur-pemda',
                'excerpt' => 'PUPR mengadakan pelatihan khusus manajemen proyek infrastruktur untuk meningkatkan kapasitas pemerintah daerah.',
                'content' => '<p>Yogyakarta - Pusat Pendidikan dan Pelatihan PUPR menggelar pelatihan manajemen proyek infrastruktur yang diikuti oleh 150 pejabat dari 34 provinsi.</p><p>Pelatihan ini mencakup modul perencanaan, pengadaan, pelaksanaan, dan monitoring evaluasi proyek infrastruktur.</p><p>Diharapkan setelah mengikuti pelatihan ini, pemerintah daerah dapat mengelola proyek infrastruktur dengan lebih efektif dan efisien.</p>',
                'category_id' => $categories->where('slug', 'edukasi')->first()?->id ?? 8,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(8),
                'tags' => ['pelatihan', 'manajemen proyek', 'pemerintah daerah', 'infrastruktur'],
            ],
            [
                'title' => 'Draft Peraturan Baru tentang Standar Bangunan Tahan Bencana',
                'slug' => 'draft-peraturan-standar-bangunan-tahan-bencana',
                'excerpt' => 'PUPR menyusun draft peraturan baru tentang standar bangunan tahan bencana yang akan diberlakukan tahun 2026.',
                'content' => '<p>Jakarta - Badan Standardisasi PUPR menyusun draft peraturan baru tentang standar bangunan tahan bencana yang akan diberlakukan mulai tahun 2026.</p><p>Peraturan ini mencakup standar konstruksi untuk bangunan di zona rawan gempa, banjir, tsunami, dan longsor.</p><p>Draft peraturan ini akan disosialisasikan kepada stakeholder konstruksi sebelum disahkan menjadi peraturan resmi.</p>',
                'category_id' => $categories->where('slug', 'pengumuman')->first()?->id ?? 2,
                'author_id' => $author->id,
                'status' => 'draft',
                'is_featured' => false,
                'published_at' => null,
                'tags' => ['peraturan', 'standar', 'tahan bencana', 'konstruksi'],
            ],
            [
                'title' => 'Evaluasi Dampak Program Sejuta Rumah terhadap Ekonomi Regional',
                'slug' => 'evaluasi-dampak-program-sejuta-rumah-ekonomi-regional',
                'excerpt' => 'Tim evaluasi PUPR menerbitkan laporan dampak Program Sejuta Rumah terhadap pertumbuhan ekonomi regional.',
                'content' => '<p>Jakarta - Tim evaluasi Kementerian PUPR menerbitkan laporan komprehensif tentang dampak Program Sejuta Rumah terhadap pertumbuhan ekonomi regional selama periode 2020-2024.</p><p>Laporan menunjukkan bahwa program ini telah menciptakan 500,000 lapangan kerja dan meningkatkan GDP regional rata-rata 2.3% di daerah implementasi.</p><p>Program ini juga berhasil mengurangi backlog perumahan nasional sebesar 15% dan meningkatkan akses masyarakat terhadap hunian layak.</p>',
                'category_id' => $categories->where('slug', 'program')->first()?->id ?? 6,
                'author_id' => $author->id,
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(10),
                'tags' => ['evaluasi', 'program sejuta rumah', 'ekonomi regional', 'lapangan kerja'],
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
