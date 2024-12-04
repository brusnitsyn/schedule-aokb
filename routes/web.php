<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'App', [
    'schedule' => \App\Models\ScheduleItem::all()
]);

Route::get('schedule', [\App\Http\Controllers\ScheduleController::class, 'index'])->name('schedule');

Route::post('schedule/create', [\App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.create');
Route::post('schedule/update', [\App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');
