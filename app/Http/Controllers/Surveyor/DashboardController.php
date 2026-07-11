<?php

namespace App\Http\Controllers\Surveyor;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $query = Survey::where('surveyor_id', auth()->id());
        return view('surveyor.dashboard', [
            'stats' => [
                'assigned' => (clone $query)->where('status', 'assigned')->count(),
                'verified' => (clone $query)->where('status', 'verified')->count(),
                'rejected' => (clone $query)->where('status', 'rejected')->count(),
            ],
            'upcoming' => (clone $query)->with('citizen')->where('status', 'assigned')->orderBy('scheduled_at')->limit(8)->get(),
        ]);
    }
}
