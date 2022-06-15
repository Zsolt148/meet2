<?php

use App\Http\Controllers\Api\MeetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/meet/contents/{meetId}/{method?}/{param?}', MeetController::class)->name('meet.contents');

Route::get('/meet/{meetId}/competitor/{competitorId}/entry/time/{meetEventId}', \App\Http\Controllers\Api\EntryTimeController::class)->name('meet.entry.time');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');
