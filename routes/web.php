<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MeetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/meets/{meet:slug}', [MeetController::class, 'show'])->name('meets.show');
Route::get('/meets/{meet:slug}/entries', [MeetController::class, 'show'])->name('meet	s.show');
Route::get('/meets', [MeetController::class, 'index'])->name('meets.index');

Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);
    return redirect()->back();
})->name('language');

//todo
Route::post('fileupload/store/{name}', [\App\Http\Controllers\FileUploadController::class, 'store']);

// Jetstream and Fortify routes
require __DIR__ . '/jetstream.php';

// Portal
require __DIR__ . '/portal/web.php';

// Admin auth
require __DIR__ . '/admin/web.php';