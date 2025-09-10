<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Define additional settings to add
        $additionalSettings = [
            // Site settings
            [
                'key' => 'site.location',
                'value' => 'Provinsi Jambi',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Site location for footer copyright',
                'is_public' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'site.copyright',
                'value' => 'Seluruh hak cipta dilindungi.',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Copyright text for footer',
                'is_public' => true,
                'sort_order' => 6,
            ],
            [
                'key' => 'site.developer_credit',
                'value' => 'Dikembangkan oleh Tim IT PUPR Provinsi Jambi',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Developer credit text for footer',
                'is_public' => true,
                'sort_order' => 7,
            ],
            
            // Statistics settings
            [
                'key' => 'stats.title',
                'value' => 'Data & Statistik Provinsi Jambi',
                'type' => 'text',
                'group' => 'statistics',
                'description' => 'Statistics section title',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'stats.districts_label',
                'value' => 'Kabupaten/Kota',
                'type' => 'text',
                'group' => 'statistics',
                'description' => 'Districts label',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'stats.population_label',
                'value' => 'Juta Penduduk',
                'type' => 'text',
                'group' => 'statistics',
                'description' => 'Population label',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'stats.growth_label',
                'value' => 'Pertumbuhan Ekonomi',
                'type' => 'text',
                'group' => 'statistics',
                'description' => 'Economic growth label',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'stats.tourists_label',
                'value' => 'Juta Wisatawan',
                'type' => 'text',
                'group' => 'statistics',
                'description' => 'Tourists label',
                'is_public' => true,
                'sort_order' => 5,
            ],
            
            // Links settings
            [
                'key' => 'links.ministry_name',
                'value' => 'Kementerian Dalam Negeri',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Ministry link name',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'links.ministry_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Ministry link URL',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'links.statistics_name',
                'value' => 'Badan Pusat Statistik',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Statistics link name',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'links.statistics_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Statistics link URL',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'links.pupr_name',
                'value' => 'Kementerian PUPR',
                'type' => 'text',
                'group' => 'links',
                'description' => 'PUPR link name',
                'is_public' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'links.pupr_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'links',
                'description' => 'PUPR link URL',
                'is_public' => true,
                'sort_order' => 6,
            ],
            [
                'key' => 'links.bpk_name',
                'value' => 'BPK RI',
                'type' => 'text',
                'group' => 'links',
                'description' => 'BPK link name',
                'is_public' => true,
                'sort_order' => 7,
            ],
            [
                'key' => 'links.bpk_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'links',
                'description' => 'BPK link URL',
                'is_public' => true,
                'sort_order' => 8,
            ],
            [
                'key' => 'links.province_name',
                'value' => 'Pemerintah Provinsi Jambi',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Province link name',
                'is_public' => true,
                'sort_order' => 9,
            ],
            [
                'key' => 'links.province_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'links',
                'description' => 'Province link URL',
                'is_public' => true,
                'sort_order' => 10,
            ],
            
            // Services settings
            [
                'key' => 'services.complaint_name',
                'value' => 'Pengaduan Masyarakat',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Complaint service name',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'services.complaint_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Complaint service link',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'services.licensing_name',
                'value' => 'Perizinan Online',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Licensing service name',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'services.licensing_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Licensing service link',
                'is_public' => true,
                'sort_order' => 4,
            ],
            [
                'key' => 'services.opendata_name',
                'value' => 'Data Terbuka',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Open data service name',
                'is_public' => true,
                'sort_order' => 5,
            ],
            [
                'key' => 'services.opendata_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Open data service link',
                'is_public' => true,
                'sort_order' => 6,
            ],
            [
                'key' => 'services.egov_name',
                'value' => 'E-Government',
                'type' => 'text',
                'group' => 'services',
                'description' => 'E-Government service name',
                'is_public' => true,
                'sort_order' => 7,
            ],
            [
                'key' => 'services.egov_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'services',
                'description' => 'E-Government service link',
                'is_public' => true,
                'sort_order' => 8,
            ],
            [
                'key' => 'services.jobs_name',
                'value' => 'Lowongan Kerja',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Jobs service name',
                'is_public' => true,
                'sort_order' => 9,
            ],
            [
                'key' => 'services.jobs_link',
                'value' => '#',
                'type' => 'text',
                'group' => 'services',
                'description' => 'Jobs service link',
                'is_public' => true,
                'sort_order' => 10,
            ],
            
            // Contact settings
            [
                'key' => 'contact.hours',
                'value' => 'Senin-Jumat: 08.00-16.00 WIB',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Office hours',
                'is_public' => true,
                'sort_order' => 5,
            ],
        ];
        
        // Insert the additional settings
        foreach ($additionalSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Define keys to remove
        $keysToRemove = [
            'site.location',
            'site.copyright',
            'site.developer_credit',
            'stats.title',
            'stats.districts_label',
            'stats.population_label',
            'stats.growth_label',
            'stats.tourists_label',
            'links.ministry_name',
            'links.ministry_link',
            'links.statistics_name',
            'links.statistics_link',
            'links.pupr_name',
            'links.pupr_link',
            'links.bpk_name',
            'links.bpk_link',
            'links.province_name',
            'links.province_link',
            'services.complaint_name',
            'services.complaint_link',
            'services.licensing_name',
            'services.licensing_link',
            'services.opendata_name',
            'services.opendata_link',
            'services.egov_name',
            'services.egov_link',
            'services.jobs_name',
            'services.jobs_link',
            'contact.hours',
        ];
        
        // Remove the additional settings
        foreach ($keysToRemove as $key) {
            Setting::where('key', $key)->delete();
        }
    }
};