<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'App', [
    'schedule' => \App\Models\ScheduleItem::all()
]);

Route::inertia('/admin/schedule/create', 'Admin/Schedule/CreateItem', [
    'schedule' => \App\Models\ScheduleItem::all()
]);
