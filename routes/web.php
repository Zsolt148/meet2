<?php

use App\Http\Controllers\Site\MeetController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Site/SiteHome');
})->name('home');

Route::get('/meets/{meet:slug}', [MeetController::class, 'show'])->name('meets.show');
Route::get('/meets', [MeetController::class, 'index'])->name('meets.index');

Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);
    return redirect()->back();
})->name('language');

// Jetstream and Fortify routes
Route::middleware(['web'])->group(base_path('routes/jetstream.php'));

// Portal
Route::middleware(['auth:sanctum', 'verified', 'web'])
    ->prefix('portal')
    ->name('portal:')
    ->group(base_path('routes/portal.php'));

// Admin auth
Route::prefix('admin')
    ->name('admin:')
    ->middleware(['auth:sanctum', 'verified', 'web', 'role:admin'])
    ->group(base_path('routes/admin.php'));