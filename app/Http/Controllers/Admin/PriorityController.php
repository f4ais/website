<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PriorityController extends Controller
{
    public function index(Request $request): View
    {
        $rankings = Survey::with(['citizen', 'surveyor'])
            ->where('status', 'verified')
            ->when($request->filled('wilayah'), fn ($q) => $q->whereHas('citizen', fn ($sub) => $sub->where('wilayah', $request->wilayah)))
            ->orderByDesc('priority_score')
            ->orderBy('surveyed_at')
            ->paginate(20)->withQueryString();

        return view('admin.priorities.index', compact('rankings'));
    }
}
