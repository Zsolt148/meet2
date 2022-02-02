<?php

// Users
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MeetController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventController;

Route::prefix('admin')
    ->name('admin:')
    ->middleware(['auth:sanctum', 'verified', 'role:admin'])
    ->group(function () {

        Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');

        Route::post('teams/sync', [TeamController::class, 'sync'])->name('teams.sync');
        Route::resource('teams', TeamController::class);

        Route::resource('locations', LocationController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::resource('contacts', ContactController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::delete('meets/destroy/media/{mediaId}', [MeetController::class, 'destroyMedia'])->name('meets.delete.media');
        Route::resource('meets', MeetController::class);

        Route::resource('events', EventController::class);

    });