<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Utama',
                'slug' => 'berita-utama',
                'description' => 'Berita utama dan highlight penting dari organisasi',
                'color' => '#ef4444',
                'icon' => 'heroicon-o-fire',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Pengumuman resmi dan informasi penting',
                'color' => '#3b82f6',
                'icon' => 'heroicon-o-megaphone',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kegiatan',
                'slug' => 'kegiatan',
                'description' => 'Laporan kegiatan dan acara yang telah dilaksanakan',
                'color' => '#10b981',
                'icon' => 'heroicon-o-calendar-days',
                'status' => 'active',
                'sort_order' => 3,
            ],
            [
                'name' => 'Prestasi',
                'slug' => 'prestasi',
                'description' => 'Prestasi dan penghargaan yang diraih organisasi',
                'color' => '#f59e0b',
                'icon' => 'heroicon-o-trophy',
                'status' => 'active',
                'sort_order' => 4,
            ],
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Berita dan update terkait teknologi dan inovasi',
                'color' => '#8b5cf6',
                'icon' => 'heroicon-o-cpu-chip',
                'status' => 'active',
                'sort_order' => 5,
            ],
            [
                'name' => 'Program',
                'slug' => 'program',
                'description' => 'Program-program dan inisiatif organisasi',
                'color' => '#06b6d4',
                'icon' => 'heroicon-o-briefcase',
                'status' => 'active',
                'sort_order' => 6,
            ],
            [
                'name' => 'Kerjasama',
                'slug' => 'kerjasama',
                'description' => 'Kerjasama dan partnership dengan berbagai pihak',
                'color' => '#84cc16',
                'icon' => 'heroicon-o-handshake',
                'status' => 'active',
                'sort_order' => 7,
            ],
            [
                'name' => 'Edukasi',
                'slug' => 'edukasi',
                'description' => 'Konten edukatif dan pembelajaran',
                'color' => '#f97316',
                'icon' => 'heroicon-o-academic-cap',
                'status' => 'active',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
