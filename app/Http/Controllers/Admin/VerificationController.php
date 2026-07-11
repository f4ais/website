<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citizen;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(Request $request): View
    {
        $surveys = Survey::with(['citizen', 'surveyor'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()->paginate(12)->withQueryString();

        $pendingCitizens = Citizen::where('verification_status', 'pending')->orderBy('name')->get();
        $surveyors = User::where('role', 'surveyor')->where('is_active', true)->orderBy('name')->get();

        return view('admin.verifications.index', compact('surveys', 'pendingCitizens', 'surveyors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'citizen_id' => ['required', 'exists:citizens,id'],
            'surveyor_id' => ['required', 'exists:users,id'],
            'scheduled_at' => ['nullable', 'date'],
        ]);

        $citizen = Citizen::findOrFail($data['citizen_id']);
        abort_unless($citizen->verification_status === 'pending', 422, 'Warga sudah memiliki proses verifikasi.');

        Survey::create($data + ['status' => 'assigned']);
        $citizen->update(['verification_status' => 'assigned']);

        return back()->with('success', 'Surveyor berhasil ditugaskan.');
    }

    public function show(Survey $survey): View
    {
        $survey->load(['citizen', 'surveyor']);
        return view('admin.verifications.show', compact('survey'));
    }
}
