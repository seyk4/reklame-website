<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $depokLat = -6.4025;
        $depokLng = 106.7942;
        return [
            'nama_proyek' => 'Reklame ' . $this->faker->streetName,
            'deskripsi' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Baru', 'Produksi', 'Selesai']),
            'client_id' => Client::factory(),
            // Hasilkan koordinat acak di sekitar Depok
            'latitude' => $this->faker->latitude($depokLat - 0.05, $depokLat + 0.05),
            'longitude' => $this->faker->longitude($depokLng - 0.05, $depokLng + 0.05),
        ];
    }
}
