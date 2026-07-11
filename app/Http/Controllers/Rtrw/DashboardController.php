<?php

namespace App\Http\Controllers\Rtrw;

use App\Http\Controllers\Controller;
use App\Models\Citizen;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $query = Citizen::inRegion(auth()->user()->wilayah);
        return view('rtrw.dashboard', [
            'stats' => [
                'warga' => (clone $query)->count(),
                'pending' => (clone $query)->where('verification_status', 'pending')->count(),
                'assigned' => (clone $query)->where('verification_status', 'assigned')->count(),
                'verified' => (clone $query)->where('verification_status', 'verified')->count(),
            ],
            'latestCitizens' => (clone $query)->with('latestSurvey')->latest()->limit(6)->get(),
        ]);
    }
}
