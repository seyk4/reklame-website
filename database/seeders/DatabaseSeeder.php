<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
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
        
        // Buat 10 Klien, dan untuk setiap klien, buatkan 2 Proyek
        Client::factory()
              ->count(10)
              ->has(Project::factory()->count(2))
              ->create();

        // Buat 20 Proyek tambahan dengan klien acak yang sudah ada
        Project::factory()->count(20)->create();
    }
}
