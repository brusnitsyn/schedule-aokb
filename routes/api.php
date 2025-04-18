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

Route::post('/schedule/create', [\App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.create');
Route::post('/schedule/{scheduleItem}/update', [\App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{scheduleItem}/delete', [\App\Http\Controllers\ScheduleController::class, 'delete'])->name('schedule.delete');
