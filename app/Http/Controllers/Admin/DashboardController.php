<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AidProgram;
use App\Models\Citizen;
use App\Models\Recipient;
use App\Models\Survey;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'warga' => Citizen::count(),
                'menunggu' => Citizen::whereIn('verification_status', ['pending', 'assigned'])->count(),
                'terverifikasi' => Citizen::where('verification_status', 'verified')->count(),
                'penerima' => Recipient::count(),
                'programAktif' => AidProgram::where('status', 'active')->count(),
                'petugas' => User::whereIn('role', ['rtrw', 'surveyor', 'penyalur'])->count(),
            ],
            'latestSurveys' => Survey::with(['citizen', 'surveyor'])->latest()->limit(5)->get(),
        ]);
    }
}
