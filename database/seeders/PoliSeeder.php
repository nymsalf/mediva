<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{

use WithoutModelEvents;
    public function run(): void
    {
        $polis = [
            'Poli Umum', 'Poli Gigi', 'Poli Anak', 'Poli Kandungan',
            'Poli Penyakit Dalam', 'Poli Mata', 'Poli THT', 'Poli Kulit dan Kelamin',
        ];

        foreach ($polis as $nama) {
            Poli::firstOrCreate(['name' => $nama]);
        }
    }
}
