<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_klien' => $this->faker->company,
            'kontak_person' => $this->faker->name,
            'nomor_telepon' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
        ];
    }
}
