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
        Route::post('/meets/{meet}/entry/finalize/all', [EntryController::class, 'finalizeAll'])->name('meet.entry.finalize-all');
        Route::post('/meets/{meet}/entry/store', [EntryController::class, 'store'])->name('meet.entry.store');
        Route::get('/meets/{meet}/entry/{entry}', [EntryController::class, 'show'])->name('meet.entry.show');
        Route::get('/meets/{meet}/entry/{entry}/edit', [EntryController::class, 'edit'])->name('meet.entry.edit');
        Route::put('/meets/{meet}/entry/{entry}/update', [EntryController::class, 'update'])->name('meet.entry.update');
        Route::put('/meets/{meet}/entry/{entry}/finalize', [EntryController::class, 'finalize'])->name('meet.entry.finalize');
        Route::delete('/meets/{meet}/entry/{entry}/delete', [EntryController::class, 'destroy'])->name('meet.entry.delete');

    });
