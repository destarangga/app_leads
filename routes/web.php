<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\NewLeadController;
use App\Exports\LeadsExport;
use App\Exports\LeadHistoryExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('daftar');
Route::post('/login', [AuthController::class, 'login'])->name('masuk');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// ========== Auth/Admin Routes ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/data', [AuthController::class, 'index'])->name('auth.index');
    Route::get('/add-admin', [AuthController::class, 'showAdmin'])->name('admin.page');
    Route::post('/add-admin', [AuthController::class, 'addAdmin'])->name('admin.store');
    Route::delete('/data/{id}', [AuthController::class, 'delete'])->name('auth.delete');

    Route::get('/profile', [AuthController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AuthController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
});

// ========== New Leads Routes ==========
Route::middleware(['auth'])->prefix('import-leads')->group(function () {
    Route::get('/', [NewLeadController::class, 'showLeads'])->name('leads.show');
    Route::post('/', [NewLeadController::class, 'import'])->name('leads.import');
    Route::get('/form', [NewLeadController::class, 'showImport'])->name('leads.import.form');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/leads-export', [NewLeadController::class, 'export'])->name('leads.cetak');
    Route::delete('/leads/template/{id}', [NewLeadController::class, 'deleteTemplate'])->name('leads.deleteTemplate');
});

// ========== Main Leads Routes ==========
Route::middleware(['auth'])->prefix('leads')->group(function () {
    Route::get('/', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/', [LeadController::class, 'store'])->name('leads.store');

    Route::get('/{id}/history', [LeadController::class, 'history'])->name('leads.history');
    Route::post('/{id}/follow-up', [LeadController::class, 'updateFollowUp'])->name('leads.follow-up');
    Route::post('/{id}/take', [LeadController::class, 'take'])->name('leads.take');

    Route::post('/upload', [LeadController::class, 'uploadLeads'])->name('leads.upload');
    Route::post('/api', [LeadController::class, 'storeLeadsViaAPI'])->name('leads.api.store');

    Route::get('/monitoring', [LeadController::class, 'monitoringLeads'])->name('leads.monitoring');
    Route::get('/follow-up-list', [LeadController::class, 'followUpList'])->name('leads.follow-up-list');

    Route::get('/export', function (Request $request) {
        $status = $request->get('status');
        return Excel::download(new LeadsExport($status), 'leads.xlsx');
    })->name('leads.export');

    Route::get('/{id}/export-history', function ($id) {
        return Excel::download(new LeadHistoryExport, 'riwayat_follow_up_lead.xlsx');
    })->name('leads.export-history');
});
