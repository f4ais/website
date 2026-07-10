<?php

namespace App\Http\Controllers;

use App\Models\Penyaluran;
use App\Models\ProgramBantuan;
use App\Models\Rekomendasi;
use Carbon\Carbon;

class PenyaluranController extends Controller
{
    public function index()
    {
        $penyalurans = Penyaluran::with(['warga','program'])->latest()->get();

        return view('penyaluran.index', compact('penyalurans'));
    }

    public function salurkan(ProgramBantuan $program)
    {
        // Hapus penyaluran lama untuk program ini
        Penyaluran::where('program_bantuan_id', $program->id)->delete();

        // Ambil ranking sesuai kouta
        $rekomendasi = Rekomendasi::where('program_bantuan_id', $program->id)->orderBy('ranking')->take($program->kouta)->get();

        foreach ($rekomendasi as $item) {

            Penyaluran::create(['warga_id' => $item->warga_id,'program_bantuan_id' => $program->id,'tanggal_penyaluran' => Carbon::today(),'status' => 'disalurkan','keterangan' => 'Lolos rekomendasi SAW']);
        }

        return redirect()->route('penyaluran.index')->with('success','Penyaluran berhasil dilakukan.');
    }
}