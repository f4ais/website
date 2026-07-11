<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AidProgram;
use App\Models\Citizen;
use App\Models\Recipient;
use App\Models\Survey;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('admin.reports.index', [
            'summary' => [
                'warga' => Citizen::count(),
                'verified' => Survey::where('status', 'verified')->count(),
                'rejected' => Survey::where('status', 'rejected')->count(),
                'recipients' => Recipient::count(),
                'distributed' => Recipient::where('status', 'tersalurkan')->count(),
            ],
            'programs' => AidProgram::withCount('recipients')->get(),
            'regions' => Citizen::selectRaw('wilayah, count(*) as total')->groupBy('wilayah')->orderBy('wilayah')->get(),
        ]);
    }

    public function export(): Response
    {
        $rows = Recipient::with(['program', 'citizen.latestSurvey', 'distribution'])->get();
        $csv = "Program,NIK,Nama,Wilayah,Skor Prioritas,Status,Disalurkan Pada\n";

        foreach ($rows as $row) {
            $csv .= collect([
                $row->program->name,
                $row->citizen->nik,
                $row->citizen->name,
                $row->citizen->wilayah,
                $row->citizen->latestSurvey?->priority_score ?? 0,
                $row->status,
                optional($row->distribution?->distributed_at)->format('Y-m-d H:i') ?? '',
            ])->map(fn ($value) => '"'.str_replace('"', '""', (string) $value).'"')->implode(',')."\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="laporan-bansos-'.now()->format('Ymd').'.csv"',
        ]);
    }
}
