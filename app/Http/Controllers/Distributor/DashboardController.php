<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('distributor.dashboard', [
            'stats' => [
                'ditetapkan' => Recipient::where('status', 'ditetapkan')->count(),
                'diproses' => Recipient::where('status', 'diproses')->count(),
                'tersalurkan' => Recipient::where('status', 'tersalurkan')->count(),
                'gagal' => Recipient::where('status', 'gagal')->count(),
            ],
            'latest' => Recipient::with(['program', 'citizen'])->latest('determined_at')->limit(8)->get(),
        ]);
    }
}
