<?php

use App\Http\Controllers\Api\NPlusOneController;
use App\Http\Controllers\Api\PlaygroundController;
use Illuminate\Support\Facades\Route;

// ルート定義
Route::prefix('playground')->controller(PlaygroundController::class)->group(function () {
    Route::get('/sample', 'sample');
    Route::get('/buggy-continue-level-example', 'buggyContinueLevelExample');
    Route::get('/correct-continue-level-example', 'correctContinueLevelExample');
});

Route::prefix('n-plus-one')->controller(NPlusOneController::class)->group(function () {
    Route::get('/buggy', 'buggy');
    Route::get('/correct', 'correct');
});
