<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateExistingUsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update all users without roles to have default 'user' role
        User::whereNull('role')->update(['role' => 'user']);
        
        // Ensure admin user has admin role
        User::where('email', 'admin@admin.com')->update(['role' => 'admin']);
        
        echo "Updated existing users with default roles.\n";
    }
}