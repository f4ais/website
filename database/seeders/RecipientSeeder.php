<?php

namespace Database\Seeders;

use App\Models\AidProgram;
use App\Models\Citizen;
use App\Models\Distribution;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipientSeeder extends Seeder
{
    public function run(): void
    {
        $program = AidProgram::where('code', 'BLT-2026')->firstOrFail();
        $admin = User::where('email', 'admin@sipbansos.test')->firstOrFail();
        $distributor = User::where('email', 'penyalur@sipbansos.test')->firstOrFail();

        foreach (['6101010101800001', '6101010201750002'] as $index => $nik) {
            $citizen = Citizen::where('nik', $nik)->firstOrFail();
            $recipient = Recipient::updateOrCreate([
                'aid_program_id' => $program->id,
                'citizen_id' => $citizen->id,
            ], [
                'determined_by' => $admin->id,
                'determined_at' => now()->subDays(2),
                'status' => $index === 0 ? 'tersalurkan' : 'ditetapkan',
                'notes' => 'Ditetapkan berdasarkan ranking prioritas.',
            ]);

            if ($index === 0) {
                Distribution::updateOrCreate(['recipient_id' => $recipient->id], [
                    'distributor_id' => $distributor->id,
                    'distributed_at' => now()->subDay(),
                    'status' => 'tersalurkan',
                    'notes' => 'Bantuan diterima langsung oleh penerima.',
                ]);
            }
        }
    }
}
