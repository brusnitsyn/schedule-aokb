<?php

use Illuminate\Support\Facades\Route;

//Route::inertia('/', 'App', [
//    'schedule' => \App\Models\ScheduleItem::orderBy('id')->with('statusScheduleItem')->get()
//]);

Route::get('/', [\App\Http\Controllers\ScheduleController::class, 'page'])->name('schedule.page');

Route::get('/schedule', [\App\Http\Controllers\ScheduleController::class, 'index'])->name('schedule');
