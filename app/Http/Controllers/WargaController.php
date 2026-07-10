<?php

namespace App\Http\Controllers;

// Import Form Request sudah benar
use App\Http\Requests\StoreWargaRequest;
use App\Http\Requests\UpdateWargaRequest;
use App\Models\Warga;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::with(['wilayah', 'creator']);

        if ($request->filled('wilayah_id')) {
            $query->where('wilayah_id', $request->wilayah_id);
        }

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        $wargas = $query->latest()->paginate(10);
        $wilayahs = Wilayah::all();

        return view('warga.index', compact('wargas', 'wilayahs'));
    }

    public function create()
    {
        $wilayahs = \App\Models\Wilayah::all();
        return view('warga.create', compact('wilayahs'));
    }

    /**
     * PERBAIKAN: Menggunakan StoreWargaRequest, bukan Request biasa
     */
    public function store(StoreWargaRequest $request)
    {
        // Validasi manual dihapus karena sudah ditangani oleh StoreWargaRequest secara otomatis

        Warga::create(array_merge($request->validated(), [
            'created_by' => Auth::id(),
            'status_verifikasi' => 'pending',
        ]));

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $wilayahs = Wilayah::all();
        return view('warga.edit', compact('warga', 'wilayahs'));
    }

    public function update(UpdateWargaRequest $request, Warga $warga)
    {
        $warga->update($request->validated());

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}