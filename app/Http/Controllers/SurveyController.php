<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    // Menampilkan daftar warga yang akan diverifikasi
    public function index()
    {
        $wargas = Warga::with('wilayah')
            ->orderBy('nama')
            ->get();

        return view('survey.index', compact('wargas'));
    }

    // Menampilkan form verifikasi survey
    public function show(Warga $warga)
    {
        // Cek apakah warga sudah pernah disurvey
        $survey = Survey::where('warga_id', $warga->id)->first();

        return view('survey.show', compact('warga', 'survey'));
    }

    // Menyimpan hasil survey
    public function store(Request $request, Warga $warga)
    {
        $data = $request->validate([
            'pekerjaan' => 'required',
            'penghasilan' => 'required|numeric',
            'tanggungan' => 'required|numeric',
            'kondisi_rumah' => 'required',
            'status_rumah' => 'required',
            'memiliki_kendaraan' => 'required|boolean',
            'memiliki_bpjs' => 'required|boolean',
            'catatan' => 'nullable',
            'status' => 'required',
            'bukti_survey' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('bukti_survey'))
        {
            $data['bukti_survey'] = $request->file('bukti_survey')->store('survey','public');
        }
        
        $data['warga_id'] =$warga->id;
        $data['created_by'] = Auth::id();
        $data['status'] = 'verified';

        Survey::updateOrCreate(
            [
            'warga_id' => $warga->id,
            ],
            $data 
        );

        $warga->update([
            'status_verifikasi'=>'verified'
        ]);

        return redirect()->route('survey.index')->with('success', 'Survey Berhasil Disimpan.');
    }
}