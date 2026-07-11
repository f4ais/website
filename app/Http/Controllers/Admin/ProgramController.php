<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AidProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = AidProgram::withCount('recipients')->latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.programs.form', ['program' => new AidProgram]);
    }

    public function store(Request $request): RedirectResponse
    {
        AidProgram::create($this->validated($request));
        return redirect()->route('admin.programs.index')->with('success', 'Program bantuan berhasil dibuat.');
    }

    public function edit(AidProgram $program): View
    {
        return view('admin.programs.form', compact('program'));
    }

    public function update(Request $request, AidProgram $program): RedirectResponse
    {
        $program->update($this->validated($request, $program));
        return redirect()->route('admin.programs.index')->with('success', 'Program bantuan berhasil diperbarui.');
    }

    public function destroy(AidProgram $program): RedirectResponse
    {
        abort_if($program->recipients()->exists(), 422, 'Program yang sudah memiliki penerima tidak dapat dihapus.');
        $program->delete();
        return back()->with('success', 'Program bantuan berhasil dihapus.');
    }

    private function validated(Request $request, ?AidProgram $program = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:30', Rule::unique('aid_programs')->ignore($program)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quota' => ['required', 'integer', 'min:1'],
            'budget' => ['required', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', Rule::in(['draft', 'active', 'closed'])],
        ]);
    }
}
