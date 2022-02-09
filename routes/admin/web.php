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

        Route::prefix('entries')->name('entries.')->group(function () {

            Route::get('meet', [MeetEntryController::class, 'index'])->name('meet.index');
            Route::get('meet/{meet}', [MeetEntryController::class, 'show'])->name('meet.show');
            Route::get('meet/{meet}/edit', [MeetEntryController::class, 'edit'])->name('meet.edit');
            Route::put('meet/{meet}/update', [MeetEntryController::class, 'update'])->name('meet.update');

            Route::get('meet/{meet}/events', [MeetEventController::class, 'index'])->name('meet.event.index');
            Route::get('meet/{meet}/events/create', [MeetEventController::class, 'create'])->name('meet.event.create');
            Route::post('meet/{meet}/events/store', [MeetEventController::class, 'store'])->name('meet.event.store');
            //Route::get('meet/{meet}/events/edit', [MeetEventController::class, 'edit'])->name('meet.event.edit');
            //Route::put('meet/{meet}/events/update', [MeetEventController::class, 'update'])->name('meet.event.update');
        });


        Route::resource('events', EventController::class);

    });