<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return match ($request->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'rtrw' => redirect()->route('rtrw.dashboard'),
            'surveyor' => redirect()->route('surveyor.dashboard'),
            'penyalur' => redirect()->route('penyalur.dashboard'),
            default => abort(403),
        };
    }
}
