<?php

namespace App\Http\Controllers;

use App\Events\DeletedScheduleItem;
use App\Events\UpdatedScheduleItem;
use App\Http\Requests\Admin\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Admin\Schedule\ScheduleUpdateRequest;
use App\Models\ScheduleItem;
use App\Models\StatusScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function page()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        return Inertia::render('App', [
            'schedule' => $items,
        ]);
    }

    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')
            ->get();
        $allSlots = 100;
        return Inertia::render('Schedule/Index', [
            'schedule' => $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'doctor_fio' => $item->doctor_fio,
                    'doctor_job' => $item->doctor_job,
                    'doctor_name' => $item->doctor_name,
                    'room' => $item->room,
                    'start_at' => Carbon::parse($item->start_at)->getTimestampMs(),
                    'end_at' => Carbon::parse($item->end_at)->getTimestampMs(),
                    'status_schedule_item_id' => $item->status_schedule_item_id,
                    'status_schedule' => $item->statusScheduleItem->label,
                ];
            }),
            'scheduleStatuses' => StatusScheduleItem::all(),
            'scheduleSlots' => [
                'hasDisabledAddButton' => $items->count() >= $allSlots,
                'count' => $items->count(),
                'allow' => $allSlots - $items->count(),
                'all' => $allSlots
            ]
        ]);
    }

    public function update(ScheduleItem $scheduleItem, ScheduleUpdateRequest $request)
    {
        return $request->update($scheduleItem);
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
            broadcast(new DeletedScheduleItem($saveScheduleItem));
        }

        return Redirect::route('schedule');
    }
}
