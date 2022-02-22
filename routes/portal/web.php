<?php

// Admin routes

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Portal\DashboardController;
use App\Http\Controllers\Portal\EntryController;
use App\Http\Controllers\Portal\MeetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('portal')
    ->name('portal:')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/meets', [MeetController::class, 'index'])->name('meets.index');
        Route::get('/meets/{meet:slug}', [MeetController::class, 'show'])->name('meets.show');
        Route::get('/meets/{meet}/entry/create', [EntryController::class, 'create'])->name('meet.entry.create');
        Route::post('/meets/{meet}/entry/store', [EntryController::class, 'store'])->name('meet.entry.store');

    });
