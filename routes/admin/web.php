<?php

// Users
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MeetController;
use App\Http\Controllers\Admin\MeetEntryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MeetEventController;

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

        Route::get('entries/meet', [MeetEntryController::class, 'index'])->name('entries.meet.index');
        Route::get('entries/meet/{meet}', [MeetEntryController::class, 'show'])->name('entries.meet.show');
        Route::get('entries/meet/{meet}/edit', [MeetEntryController::class, 'edit'])->name('entries.meet.edit');
        Route::put('entries/meet/{meet}/update', [MeetEntryController::class, 'update'])->name('entries.meet.update');

        Route::get('entries/meet/{meet}/events', [MeetEventController::class, 'index'])->name('entries.meet.event.index');
        Route::get('entries/meet/{meet}/events/create', [MeetEventController::class, 'create'])->name('entries.meet.event.create');
        Route::post('entries/meet/{meet}/events/store', [MeetEventController::class, 'store'])->name('entries.meet.event.store');
        //Route::get('entries/meet/{meet}/events/edit', [MeetEventController::class, 'edit'])->name('entries.meet.event.edit');
        //Route::put('entries/meet/{meet}/events/update', [MeetEventController::class, 'update'])->name('entries.meet.event.update');

        Route::resource('events', EventController::class);

    });