<?php

// Admin routes

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Portal\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
