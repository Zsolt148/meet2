<?php

// Admin routes

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Portal\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified', 'web'])
    ->prefix('portal')
    ->name('portal:')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    });
