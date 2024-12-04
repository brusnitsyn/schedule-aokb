<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Admin\Schedule\ScheduleUpdateRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{

    public function index()
    {
        return Inertia::render('Schedule/Index', [
            'schedule' => \App\Models\ScheduleItem::all()
        ]);
    }

    public function update(ScheduleUpdateRequest $request)
    {
        return $request->update();
    }

    public function create(ScheduleStoreRequest $request)
    {
        return $request->store();
    }
}
