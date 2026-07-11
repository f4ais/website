<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Recipient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DistributionController extends Controller
{
    public function index(Request $request): View
    {
        $recipients = Recipient::with(['program', 'citizen', 'distribution'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest('determined_at')->paginate(15)->withQueryString();
        return view('distributor.distributions.index', compact('recipients'));
    }

    public function show(Recipient $recipient): View
    {
        $recipient->load(['program', 'citizen.latestSurvey', 'distribution']);
        return view('distributor.distributions.show', compact('recipient'));
    }

    public function update(Request $request, Recipient $recipient): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['diproses', 'tersalurkan', 'gagal'])],
            'distributed_at' => ['nullable', 'required_if:status,tersalurkan', 'date'],
            'documentation_photo' => [
                'nullable',
                Rule::requiredIf(fn () => $request->status === 'tersalurkan' && ! $recipient->distribution?->documentation_photo),
                'image', 'mimes:jpg,jpeg,png,webp', 'max:4096',
            ],
            'notes' => ['nullable', 'string'],
        ]);

        $distribution = $recipient->distribution ?: new Distribution(['recipient_id' => $recipient->id]);
        $distribution->fill([
            'distributor_id' => auth()->id(),
            'status' => $data['status'],
            'distributed_at' => $data['distributed_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
        if ($request->hasFile('documentation_photo')) {
            $distribution->documentation_photo = $request->file('documentation_photo')->store('distribution-evidence', 'public');
        }
        $distribution->save();
        $recipient->update(['status' => $data['status']]);

        return redirect()->route('penyalur.distributions.index')->with('success', 'Status penyaluran berhasil diperbarui.');
    }
}
