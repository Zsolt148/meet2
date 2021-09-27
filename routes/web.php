<?php

use App\Http\Controllers\Site\MeetController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Site/Home');
})->name('home');

Route::resource('meets', MeetController::class)->only('index', 'show');


Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->name('language');

// Jetstream and Fortify routes
Route::middleware(['web'])->group(base_path('routes/jetstream.php'));

// Admin auth
Route::middleware(['auth:sanctum', 'verified', 'role:admin', 'web'])
    ->prefix('admin')
    ->name('admin:')
    ->group(base_path('routes/admin.php'));
