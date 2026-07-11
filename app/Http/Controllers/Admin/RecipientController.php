<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AidProgram;
use App\Models\Citizen;
use App\Models\Recipient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipientController extends Controller
{
    public function index(Request $request): View
    {
        $recipients = Recipient::with(['program', 'citizen.latestSurvey', 'distribution'])
            ->when($request->filled('program'), fn ($q) => $q->where('aid_program_id', $request->program))
            ->latest('determined_at')->paginate(15)->withQueryString();

        $programs = AidProgram::where('status', 'active')->withCount('recipients')->orderBy('name')->get();
        $eligibleCitizens = Citizen::with('latestSurvey')
            ->where('verification_status', 'verified')
            ->whereHas('latestSurvey', fn ($q) => $q->where('status', 'verified'))
            ->get()->sortByDesc(fn ($citizen) => $citizen->latestSurvey?->priority_score ?? 0);

        return view('admin.recipients.index', compact('recipients', 'programs', 'eligibleCitizens'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'aid_program_id' => ['required', 'exists:aid_programs,id'],
            'citizen_id' => ['required', 'exists:citizens,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $program = AidProgram::withCount('recipients')->findOrFail($data['aid_program_id']);
        abort_unless($program->status === 'active', 422, 'Program bantuan tidak aktif.');
        abort_if($program->recipients_count >= $program->quota, 422, 'Kuota program sudah penuh.');

        $citizen = Citizen::findOrFail($data['citizen_id']);
        abort_unless($citizen->verification_status === 'verified', 422, 'Warga belum lolos verifikasi.');
        abort_if(
            Recipient::where('aid_program_id', $program->id)->where('citizen_id', $citizen->id)->exists(),
            422,
            'Warga sudah ditetapkan pada program ini.'
        );

        Recipient::create($data + [
            'determined_by' => auth()->id(),
            'determined_at' => now(),
            'status' => 'ditetapkan',
        ]);

        return back()->with('success', 'Warga berhasil ditetapkan sebagai penerima bantuan.');
    }

    public function destroy(Recipient $recipient): RedirectResponse
    {
        abort_if($recipient->status === 'tersalurkan', 422, 'Penerima yang sudah menerima bantuan tidak dapat dibatalkan.');
        $recipient->delete();
        return back()->with('success', 'Penetapan penerima berhasil dibatalkan.');
    }
}
