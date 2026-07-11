<?php

namespace App\Http\Controllers\Rtrw;

use App\Http\Controllers\Controller;
use App\Models\Citizen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CitizenController extends Controller
{
    public function index(Request $request): View
    {
        $citizens = Citizen::with('latestSurvey')->inRegion(auth()->user()->wilayah)
            ->when($request->filled('search'), fn ($q) => $q->where(fn ($sub) => $sub
                ->where('name', 'like', '%'.$request->search.'%')->orWhere('nik', 'like', '%'.$request->search.'%')))
            ->latest()->paginate(12)->withQueryString();

        return view('rtrw.citizens.index', compact('citizens'));
    }

    public function create(): View
    {
        return view('rtrw.citizens.form', ['citizen' => new Citizen]);
    }

    public function store(Request $request): RedirectResponse
    {
        Citizen::create($this->validated($request) + [
            'created_by' => auth()->id(),
            'wilayah' => auth()->user()->wilayah,
        ]);
        return redirect()->route('rtrw.citizens.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Citizen $citizen): View
    {
        $this->authorizeRegion($citizen);
        return view('rtrw.citizens.form', compact('citizen'));
    }

    public function update(Request $request, Citizen $citizen): RedirectResponse
    {
        $this->authorizeRegion($citizen);
        abort_if($citizen->verification_status === 'verified', 422, 'Data warga yang sudah terverifikasi hanya dapat diubah oleh admin.');
        $citizen->update($this->validated($request, $citizen) + ['wilayah' => auth()->user()->wilayah]);
        return redirect()->route('rtrw.citizens.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function status(Citizen $citizen): View
    {
        $this->authorizeRegion($citizen);
        $citizen->load(['surveys.surveyor']);
        return view('rtrw.citizens.status', compact('citizen'));
    }

    private function authorizeRegion(Citizen $citizen): void
    {
        abort_unless($citizen->wilayah === auth()->user()->wilayah, 403);
    }

    private function validated(Request $request, ?Citizen $citizen = null): array
    {
        return $request->validate([
            'nik' => ['required', 'digits:16', Rule::unique('citizens')->ignore($citizen)],
            'family_card_number' => ['required', 'digits:16'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'birth_date' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string'],
            'rt' => ['required', 'digits_between:1,3'],
            'rw' => ['required', 'digits_between:1,3'],
            'village' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'income' => ['required', 'numeric', 'min:0'],
            'dependents' => ['required', 'integer', 'min:0', 'max:30'],
            'house_condition' => ['required', Rule::in(['sangat_tidak_layak', 'tidak_layak', 'cukup', 'layak'])],
            'has_elderly' => ['required', 'boolean'],
            'has_disability' => ['required', 'boolean'],
            'is_single_parent' => ['required', 'boolean'],
        ]);
    }
}
