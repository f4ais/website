<?php

use App\Http\Controllers\Admin\CitizenController as AdminCitizenController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RecipientController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Distributor\DashboardController as DistributorDashboardController;
use App\Http\Controllers\Distributor\DistributionController;
use App\Http\Controllers\Rtrw\CitizenController as RtrwCitizenController;
use App\Http\Controllers\Rtrw\DashboardController as RtrwDashboardController;
use App\Http\Controllers\Surveyor\DashboardController as SurveyorDashboardController;
use App\Http\Controllers\Surveyor\SurveyController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::resource('users', UserController::class)->except('show');
        Route::resource('programs', ProgramController::class)->except('show');
        Route::resource('citizens', AdminCitizenController::class)->except('show');
        Route::get('/verifications', [VerificationController::class, 'index'])->name('verifications.index');
        Route::post('/verifications', [VerificationController::class, 'store'])->name('verifications.store');
        Route::get('/verifications/{survey}', [VerificationController::class, 'show'])->name('verifications.show');
        Route::get('/priorities', [PriorityController::class, 'index'])->name('priorities.index');
        Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index');
        Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store');
        Route::delete('/recipients/{recipient}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    });

    Route::prefix('rtrw')->name('rtrw.')->middleware('role:rtrw')->group(function () {
        Route::get('/dashboard', RtrwDashboardController::class)->name('dashboard');
        Route::get('/citizens', [RtrwCitizenController::class, 'index'])->name('citizens.index');
        Route::get('/citizens/create', [RtrwCitizenController::class, 'create'])->name('citizens.create');
        Route::post('/citizens', [RtrwCitizenController::class, 'store'])->name('citizens.store');
        Route::get('/citizens/{citizen}/edit', [RtrwCitizenController::class, 'edit'])->name('citizens.edit');
        Route::put('/citizens/{citizen}', [RtrwCitizenController::class, 'update'])->name('citizens.update');
        Route::get('/citizens/{citizen}/status', [RtrwCitizenController::class, 'status'])->name('citizens.status');
    });

    Route::prefix('surveyor')->name('surveyor.')->middleware('role:surveyor')->group(function () {
        Route::get('/dashboard', SurveyorDashboardController::class)->name('dashboard');
        Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
        Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
        Route::put('/surveys/{survey}', [SurveyController::class, 'update'])->name('surveys.update');
    });

    Route::prefix('penyalur')->name('penyalur.')->middleware('role:penyalur')->group(function () {
        Route::get('/dashboard', DistributorDashboardController::class)->name('dashboard');
        Route::get('/distributions', [DistributionController::class, 'index'])->name('distributions.index');
        Route::get('/distributions/{recipient}', [DistributionController::class, 'show'])->name('distributions.show');
        Route::put('/distributions/{recipient}', [DistributionController::class, 'update'])->name('distributions.update');
    });
});
