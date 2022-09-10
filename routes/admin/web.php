<?php

// Users
use App\Http\Controllers\Admin\CompetitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\EntryExportController;
use App\Http\Controllers\Admin\EntryTeamController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MeetController;
use App\Http\Controllers\Admin\MeetEntryController;
use App\Http\Controllers\Admin\MeetExportController;
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
        Route::resource('teams', TeamController::class)->only('index', 'edit', 'update', 'destroy');

        Route::post('competitors/sync', [CompetitorController::class, 'sync'])->name('competitors.sync');
        Route::resource('competitors', CompetitorController::class);

        Route::resource('locations', LocationController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::resource('contacts', ContactController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::delete('meets/destroy/media/{mediaId}', [MeetController::class, 'destroyMedia'])->name('meets.delete.media');
        Route::resource('meets', MeetController::class);

        // Entries
        Route::prefix('entries')->name('entries.')->group(function () {

            // Meets
            Route::get('meet', [MeetEntryController::class, 'index'])->name('meet.index');
            Route::get('meet/{meet}/edit', [MeetEntryController::class, 'edit'])->name('meet.edit');
            Route::put('meet/{meet}/update', [MeetEntryController::class, 'update'])->name('meet.update');

            // Entries
            Route::get('meet/{meet}/entries', [EntryController::class, 'index'])->name('index');
            Route::get('meet/{meet}/entries/competitor/create', [EntryController::class, 'create'])->name('create');
            Route::post('meet/{meet}/entries/competitor/store', [EntryController::class, 'store'])->name('store');
            Route::get('meet/{meet}/entries/competitor/{competitor}/edit', [EntryController::class, 'edit'])->name('edit');
            Route::put('meet/{meet}/entries/competitor/{competitor}/update', [EntryController::class, 'update'])->name('update');
            Route::put('/meet/{meet}/entry/competitor/{competitor}/finalize', [EntryController::class, 'finalize'])->name('finalize');
            Route::delete('meet/{meet}/entries/{entryId}/delete', [EntryController::class, 'destroy'])->name('delete');
            Route::delete('meet/{meet}/entries/competitor/{competitor}/delete/all', [EntryController::class, 'destroyAll'])->name('delete-all');

            // By teams
			Route::get('meet/{meet}/entries/team', [EntryTeamController::class, 'index'])->name('meet.teams.index');

            // Events
            Route::get('meet/{meet}/events', [MeetEventController::class, 'index'])->name('meet.event.index');
            Route::get('meet/{meet}/events/create', [MeetEventController::class, 'create'])->name('meet.event.create');
            Route::post('meet/{meet}/events/store', [MeetEventController::class, 'store'])->name('meet.event.store');
            //Route::get('meet/{meet}/events/edit', [MeetEventController::class, 'edit'])->name('meet.event.edit');
            //Route::put('meet/{meet}/events/update', [MeetEventController::class, 'update'])->name('meet.event.update');

            // Exports
            Route::get('meet/{meet}/exports', [EntryExportController::class, 'index'])->name('exports.index');
            Route::get('meet/{meet}/exports/regular/download', [EntryExportController::class, 'regular'])->name('exports.regular');
            Route::get('meet/{meet}/exports/competitors/download', [EntryExportController::class, 'competitors'])->name('exports.competitors');
            Route::get('meet/{meet}/exports/teams/download', [EntryExportController::class, 'teams'])->name('exports.teams');
            Route::get('meet/{meet}/exports/entries/download', [EntryExportController::class, 'entries'])->name('exports.entries');
        });


        Route::resource('events', EventController::class);

    });