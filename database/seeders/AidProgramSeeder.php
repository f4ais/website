<?php

namespace Database\Seeders;

use App\Models\AidProgram;
use Illuminate\Database\Seeder;

class AidProgramSeeder extends Seeder
{
    public function run(): void
    {
        AidProgram::updateOrCreate(['code' => 'BLT-2026'], [
            'name' => 'Bantuan Langsung Tunai 2026',
            'description' => 'Bantuan tunai untuk keluarga dengan kondisi sosial ekonomi prioritas.',
            'quota' => 100,
            'budget' => 60000000,
            'start_date' => '2026-07-01',
            'end_date' => '2026-12-31',
            'status' => 'active',
        ]);

        AidProgram::updateOrCreate(['code' => 'SEMBAKO-2026'], [
            'name' => 'Paket Sembako Keluarga',
            'description' => 'Paket bahan pokok untuk rumah tangga terverifikasi.',
            'quota' => 150,
            'budget' => 45000000,
            'start_date' => '2026-07-01',
            'end_date' => '2026-10-31',
            'status' => 'active',
        ]);
    }
}
