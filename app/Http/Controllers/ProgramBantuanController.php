<?php

namespace App\Http\Controllers;

use App\Models\ProgramBantuan;
use Illuminate\Http\Request;

class ProgramBantuanController extends Controller
{
    public function index()
    {
        $programs = ProgramBantuan::latest()->paginate(10);

        return view('program.index', compact('programs'));
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required',
            'deskripsi' => 'nullable',
            'kouta' => 'required|integer|min:1',
        ]);

        ProgramBantuan::create([
            'nama_program' => $request->nama_program,
            'deskripsi' => $request->deskripsi,
            'kouta' => $request->kouta,
        ]);

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(ProgramBantuan $program)
    {
        return view('program.edit', compact('program'));
    }

    public function update(Request $request, ProgramBantuan $program)
    {
        $request->validate([
            'nama_program' => 'required',
            'deskripsi' => 'nullable',
            'kouta' => 'required|integer|min:1',
        ]);

        $program->update([
            'nama_program' => $request->nama_program,
            'deskripsi' => $request->deskripsi,
            'kouta' => $request->kouta,
        ]);

        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(ProgramBantuan $program)
    {
        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus.');
    }
}