<?php

use Illuminate\Support\Facades\Route;

//Route::inertia('/', 'App', [
//    'schedule' => \App\Models\ScheduleItem::orderBy('id')->with('statusScheduleItem')->get()
//]);

Route::get('/', [\App\Http\Controllers\ScheduleController::class, 'page'])->name('schedule.page');

Route::get('/schedule', [\App\Http\Controllers\ScheduleController::class, 'index'])->name('schedule');

Route::post('/schedule/create', [\App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.create');
Route::put('/schedule/{scheduleItem}/update', [\App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{scheduleItem}/delete', [\App\Http\Controllers\ScheduleController::class, 'delete'])->name('schedule.delete');
