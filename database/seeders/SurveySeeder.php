<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\Survey;
use App\Models\User;
use App\Services\PriorityScoreService;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run(PriorityScoreService $scoreService): void
    {
        $surveyor = User::where('email', 'surveyor@sipbansos.test')->firstOrFail();

        foreach (Citizen::all() as $citizen) {
            if ($citizen->verification_status === 'pending') continue;

            $status = $citizen->verification_status === 'assigned' ? 'assigned' : $citizen->verification_status;
            $data = [
                'citizen_id' => $citizen->id,
                'surveyor_id' => $surveyor->id,
                'scheduled_at' => now()->addDays($status === 'assigned' ? 2 : -5),
                'status' => $status,
            ];

            if ($status !== 'assigned') {
                $verified = [
                    'verified_income' => $citizen->income,
                    'verified_house_condition' => $citizen->house_condition,
                    'verified_dependents' => $citizen->dependents,
                    'verified_has_elderly' => $citizen->has_elderly,
                    'verified_has_disability' => $citizen->has_disability,
                    'verified_is_single_parent' => $citizen->is_single_parent,
                ];
                $data += $verified + [
                    'surveyed_at' => now()->subDays(4),
                    'notes' => $status === 'verified' ? 'Data dan kondisi lapangan sesuai.' : 'Tidak memenuhi kriteria program.',
                    'priority_score' => $status === 'verified' ? $scoreService->calculate($verified) : null,
                ];
            }

            Survey::updateOrCreate(['citizen_id' => $citizen->id], $data);
        }
    }
}
