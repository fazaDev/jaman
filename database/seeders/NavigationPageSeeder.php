<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class NavigationPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main navigation pages for PUPR government website

        // 1. Profil (About) page with children
        $profilPage = Page::create([
            'title' => 'Profil',
            'slug' => 'profil',
            'content' => '<h1>Profil PUPR Provinsi Jambi</h1><p>Informasi lengkap tentang Dinas Pekerjaan Umum dan Perumahan Rakyat Provinsi Jambi.</p>',
            'meta_description' => 'Profil lengkap PUPR Provinsi Jambi',
            'meta_keywords' => 'profil, pupr, jambi, dinas',
            'status' => 'published',
            'sort_order' => 1,
        ]);

        // Profil sub-pages
        Page::create([
            'title' => 'Sejarah',
            'slug' => 'sejarah',
            'content' => '<h1>Sejarah PUPR Provinsi Jambi</h1><p>Sejarah perkembangan Dinas PUPR Provinsi Jambi dari masa ke masa.</p>',
            'meta_description' => 'Sejarah PUPR Provinsi Jambi',
            'status' => 'published',
            'parent_id' => $profilPage->id,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Visi & Misi',
            'slug' => 'visi-misi',
            'content' => '<h1>Visi & Misi</h1><p>Visi dan misi PUPR Provinsi Jambi dalam melayani masyarakat.</p>',
            'meta_description' => 'Visi dan Misi PUPR Provinsi Jambi',
            'status' => 'published',
            'parent_id' => $profilPage->id,
            'sort_order' => 2,
        ]);

        Page::create([
            'title' => 'Struktur Organisasi',
            'slug' => 'struktur-organisasi',
            'content' => '<h1>Struktur Organisasi</h1><p>Struktur organisasi lengkap PUPR Provinsi Jambi.</p>',
            'meta_description' => 'Struktur Organisasi PUPR Provinsi Jambi',
            'status' => 'published',
            'parent_id' => $profilPage->id,
            'sort_order' => 3,
        ]);

        // 2. Bidang (Divisions) page with children
        $bidangPage = Page::create([
            'title' => 'Bidang',
            'slug' => 'bidang',
            'content' => '<h1>Bidang-bidang PUPR</h1><p>Informasi tentang bidang-bidang yang ada di PUPR Provinsi Jambi.</p>',
            'meta_description' => 'Bidang-bidang PUPR Provinsi Jambi',
            'status' => 'published',
            'sort_order' => 2,
        ]);

        // Bidang sub-pages
        $bidangList = [
            'Sekretariat' => 'Sekretariat PUPR Provinsi Jambi',
            'Bina Program dan Tata Ruang' => 'Bidang Bina Program dan Tata Ruang',
            'Cipta Karya' => 'Bidang Cipta Karya',
            'Sumber Daya Air' => 'Bidang Sumber Daya Air',
            'Perumahan Rakyat' => 'Bidang Perumahan Rakyat',
            'Bina Marga' => 'Bidang Bina Marga',
            'Bina Konstruksi' => 'Bidang Bina Konstruksi',
        ];

        $order = 1;
        foreach ($bidangList as $title => $description) {
            Page::create([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'content' => "<h1>{$title}</h1><p>{$description}</p>",
                'meta_description' => $description,
                'status' => 'published',
                'parent_id' => $bidangPage->id,
                'sort_order' => $order++,
            ]);
        }

        // 3. Layanan (Services) page with children
        $layananPage = Page::create([
            'title' => 'Layanan',
            'slug' => 'layanan',
            'content' => '<h1>Layanan PUPR</h1><p>Berbagai layanan yang disediakan oleh PUPR Provinsi Jambi untuk masyarakat.</p>',
            'meta_description' => 'Layanan PUPR Provinsi Jambi',
            'status' => 'published',
            'sort_order' => 3,
        ]);

        // Layanan sub-pages
        Page::create([
            'title' => 'Perizinan Online',
            'slug' => 'perizinan-online',
            'content' => '<h1>Perizinan Online</h1><p>Layanan perizinan online PUPR Provinsi Jambi.</p>',
            'meta_description' => 'Perizinan Online PUPR Jambi',
            'status' => 'published',
            'parent_id' => $layananPage->id,
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Pengaduan Masyarakat',
            'slug' => 'pengaduan-masyarakat',
            'content' => '<h1>Pengaduan Masyarakat</h1><p>Saluran pengaduan masyarakat untuk PUPR Provinsi Jambi.</p>',
            'meta_description' => 'Pengaduan Masyarakat PUPR Jambi',
            'status' => 'published',
            'parent_id' => $layananPage->id,
            'sort_order' => 2,
        ]);

        // 4. Kontak (Contact) page - single page
        Page::create([
            'title' => 'Kontak',
            'slug' => 'kontak',
            'content' => '<h1>Kontak Kami</h1><p>Informasi kontak PUPR Provinsi Jambi.</p>',
            'meta_description' => 'Kontak PUPR Provinsi Jambi',
            'status' => 'published',
            'sort_order' => 4,
        ]);
    }
}
