<?php

namespace App\Http\Controllers;

use App\Events\DeletedScheduleItem;
use App\Http\Requests\Admin\Schedule\ScheduleDeleteRequest;
use App\Http\Requests\Admin\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Admin\Schedule\ScheduleUpdateRequest;
use App\Models\ScheduleItem;
use App\Models\StatusScheduleItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function page()
    {
        $items = \App\Models\ScheduleItem::orderBy('id')->with('statusScheduleItem')->get();

        return Inertia::render('App', [
            'schedule' => $items
        ]);
    }

    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('id')->get();
        $allSlots = 30;
        return Inertia::render('Schedule/Index', [
            'schedule' => $items,
            'scheduleStatuses' => StatusScheduleItem::all(),
            'scheduleSlots' => [
                'hasDisabledAddButton' => $items->count() >= $allSlots,
                'count' => $items->count(),
                'allow' => $allSlots - $items->count(),
                'all' => $allSlots
            ]
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

    public function delete(ScheduleItem $scheduleItem)
    {
        $saveScheduleItem = $scheduleItem->toArray();
        $hasDeleted = $scheduleItem->delete();

        if ($hasDeleted) {
            broadcast(new DeletedScheduleItem($saveScheduleItem))->toOthers();
        }

        return Redirect::route('schedule');
    }
}
