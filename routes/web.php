<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Exports\LeadsExport;
use App\Exports\LeadHistoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', action: [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', action: [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('daftar');
Route::post('/login', [AuthController::class, 'login'])->name('masuk');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/data', [AuthController::class, 'index'])->name('auth.index');
    Route::get('/add-admin', [AuthController::class, 'showAdmin'])->name('admin.page');
    Route::post('/add-admin', [AuthController::class, 'addAdmin'])->name('admin.store');
    Route::delete('/data/{id}', [AuthController::class, 'delete'])->name('auth.delete');
    Route::get('/profile', [AuthController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AuthController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{id}/history', [LeadController::class, 'history'])->name('leads.history');
    Route::post('/leads/{id}/follow-up', [LeadController::class, 'updateFollowUp'])->name('leads.follow-up');
    Route::post('/leads/{id}/take', [LeadController::class, 'take'])->name('leads.take');
    Route::post('/leads/upload', [LeadController::class, 'uploadLeads'])->name('leads.upload');
    Route::post('/leads/api', [LeadController::class, 'storeLeadsViaAPI'])->name('leads.api.store');
    Route::get('/leads/monitoring', [LeadController::class, 'monitoringLeads'])->name('leads.monitoring');
    Route::get('/leads/follow-up-list', [LeadController::class, 'followUpList'])->name('leads.follow-up-list');
    Route::get('leads/export', function (Request $request) {
        $status = $request->get('status'); // Ambil parameter status dari request
        return Excel::download(new LeadsExport($status), 'leads.xlsx');
    })->name('leads.export');
    Route::get('/leads/{id}/export-history', function ($id) {
        return Excel::download(new LeadHistoryExport, 'riwayat_follow_up_lead.xlsx');
    })->name('leads.export-history');
});



