<?php

// Users
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\UsersController;

Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');

Route::resource('locations', LocationController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

Route::resource('contacts', ContactController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');