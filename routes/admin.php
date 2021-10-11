<?php

// Users
use App\Http\Controllers\Admin\UsersController;

Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');