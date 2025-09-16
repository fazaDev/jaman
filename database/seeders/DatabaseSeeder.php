<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create admin user for Filament
        $this->call(AdminUserSeeder::class);

        // Update existing users role
        // $this->call(UpdateExistingUsersRoleSeeder::class);

        // Create categories
        // $this->call(CategorySeeder::class);

        // Create sample pages
        // $this->call(PageSeeder::class);

        // Create sample sliders
        // $this->call(SliderSeeder::class);

        // Create sample galleries
        // $this->call(GallerySeeder::class);

        // Create sample news (should be after categories)
        // $this->call(NewsSeeder::class);

        // Create settings
        // $this->call(SettingSeeder::class);

        // Create sample announcements
        // $this->call(AnnouncementSeeder::class);

        // Create sample agendas
        // $this->call(AgendaSeeder::class);
    }
}
