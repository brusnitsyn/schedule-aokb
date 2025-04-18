<?php

use App\Http\Controllers\Api\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('schedule')->group(function () {
    Route::get('/', [ScheduleController::class, 'index']);
});
