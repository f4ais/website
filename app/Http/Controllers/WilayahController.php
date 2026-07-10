<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayah = Wilayah::all();
        return view('wilayah.index', compact('wilayah'));
    }

    public function create()
    {
        return view('wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        Wilayah::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('wilayah.index');
    }

    public function show(Wilayah $wilayah)
    {
        return view('wilayah.show', compact('wilayah'));
    }

    public function edit(Wilayah $wilayah)
    {
        return view('wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $wilayah->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('wilayah.index');
    }

    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('wilayah.index');
    }
}