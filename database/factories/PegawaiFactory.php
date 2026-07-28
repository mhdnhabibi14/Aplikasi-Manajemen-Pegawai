<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pegawai' => $this->faker-> name(),
            'nik' => $this->faker-> randomNumber(9),
            'alamat' => $this->faker-> address(),
            'umur' => $this->faker-> numberBetween(18, 35),
            'tanggal_lahir' => $this->faker-> date('Y-m-d', '2000-01-01'),
            'tempat_lahir' => $this->faker-> city(),
            'jenis_kelamin' => $this->faker-> randomElement(['laki-laki', 'perempuan']),
        ];
    }
}
