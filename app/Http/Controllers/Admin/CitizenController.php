<?php

namespace App\Http\Controllers\Admin;

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
        $citizens = Citizen::with(['creator', 'latestSurvey'])
            ->when($request->filled('search'), fn ($q) => $q->where(fn ($sub) => $sub
                ->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('nik', 'like', '%'.$request->search.'%')))
            ->when($request->filled('status'), fn ($q) => $q->where('verification_status', $request->status))
            ->when($request->filled('wilayah'), fn ($q) => $q->where('wilayah', $request->wilayah))
            ->latest()->paginate(12)->withQueryString();

        $wilayahList = Citizen::query()->distinct()->orderBy('wilayah')->pluck('wilayah');
        return view('admin.citizens.index', compact('citizens', 'wilayahList'));
    }

    public function create(): View
    {
        return view('admin.citizens.form', ['citizen' => new Citizen]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['created_by'] = auth()->id();
        Citizen::create($data);
        return redirect()->route('admin.citizens.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Citizen $citizen): View
    {
        return view('admin.citizens.form', compact('citizen'));
    }

    public function update(Request $request, Citizen $citizen): RedirectResponse
    {
        $citizen->update($this->validated($request, $citizen));
        return redirect()->route('admin.citizens.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Citizen $citizen): RedirectResponse
    {
        $citizen->delete();
        return back()->with('success', 'Data warga berhasil dihapus.');
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
            'wilayah' => ['required', 'string', 'max:100'],
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
