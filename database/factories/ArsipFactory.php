<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arsip>
 */
class ArsipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_surat_jalan' => $this->faker->unique()->numerify('SJ-#####'),
            'customer' => $this->faker->company,
            'tanggal_surat' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'kode_surat' => '#' . $this->faker->unique()->numberBetween(10000, 99999),
        ];
    }
}
