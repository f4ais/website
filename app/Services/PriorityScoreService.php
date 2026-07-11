<?php

namespace App\Services;

use App\Models\Survey;

class PriorityScoreService
{
    public function calculate(array $data): int
    {
        $score = 0;
        $income = (float) $data['verified_income'];

        $score += match (true) {
            $income <= 1_000_000 => 30,
            $income <= 1_500_000 => 25,
            $income <= 2_000_000 => 20,
            $income <= 2_500_000 => 10,
            default => 0,
        };

        $score += match ($data['verified_house_condition']) {
            'sangat_tidak_layak' => 25,
            'tidak_layak' => 20,
            'cukup' => 10,
            default => 0,
        };

        $score += min(((int) $data['verified_dependents']) * 4, 20);
        $score += filter_var($data['verified_has_elderly'], FILTER_VALIDATE_BOOL) ? 10 : 0;
        $score += filter_var($data['verified_has_disability'], FILTER_VALIDATE_BOOL) ? 10 : 0;
        $score += filter_var($data['verified_is_single_parent'], FILTER_VALIDATE_BOOL) ? 5 : 0;

        return min($score, 100);
    }

    public function recalculate(Survey $survey): int
    {
        return $this->calculate($survey->only([
            'verified_income', 'verified_house_condition', 'verified_dependents',
            'verified_has_elderly', 'verified_has_disability', 'verified_is_single_parent',
        ]));
    }
}
