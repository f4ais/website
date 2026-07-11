<?php

namespace App\Http\Controllers\Surveyor;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Services\PriorityScoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SurveyController extends Controller
{
    public function index(Request $request): View
    {
        $surveys = Survey::with('citizen')->where('surveyor_id', auth()->id())
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->orderByRaw("CASE WHEN status = 'assigned' THEN 0 ELSE 1 END")
            ->orderBy('scheduled_at')->paginate(12)->withQueryString();
        return view('surveyor.surveys.index', compact('surveys'));
    }

    public function show(Survey $survey): View
    {
        $this->authorizeSurvey($survey);
        $survey->load('citizen');
        return view('surveyor.surveys.show', compact('survey'));
    }

    public function update(Request $request, Survey $survey, PriorityScoreService $scoreService): RedirectResponse
    {
        $this->authorizeSurvey($survey);
        abort_unless($survey->status === 'assigned', 422, 'Survei ini sudah diselesaikan.');

        $data = $request->validate([
            'status' => ['required', Rule::in(['verified', 'rejected'])],
            'verified_income' => ['required', 'numeric', 'min:0'],
            'verified_house_condition' => ['required', Rule::in(['sangat_tidak_layak', 'tidak_layak', 'cukup', 'layak'])],
            'verified_dependents' => ['required', 'integer', 'min:0', 'max:30'],
            'verified_has_elderly' => ['required', 'boolean'],
            'verified_has_disability' => ['required', 'boolean'],
            'verified_is_single_parent' => ['required', 'boolean'],
            'notes' => ['required', 'string'],
            'evidence_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['evidence_photo'] = $request->file('evidence_photo')->store('survey-evidence', 'public');
        $data['surveyed_at'] = now();
        $data['priority_score'] = $data['status'] === 'verified' ? $scoreService->calculate($data) : null;
        $survey->update($data);
        $survey->citizen->update(['verification_status' => $data['status']]);

        return redirect()->route('surveyor.surveys.index')->with('success', 'Hasil survei berhasil disimpan.');
    }

    private function authorizeSurvey(Survey $survey): void
    {
        abort_unless($survey->surveyor_id === auth()->id(), 403);
    }
}
