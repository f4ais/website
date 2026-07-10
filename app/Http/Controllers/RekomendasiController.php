<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use App\Services\SAWService;

class RekomendasiController extends Controller
{
    public function index(SAWService $saw)
    {
        // Hitung ulang ranking
        $saw->hitung();

        $rekomendasis = Rekomendasi::with(['warga','program'])->orderBy('ranking')->get();

        return view('rekomendasi.index',compact('rekomendasis'));
    }
}