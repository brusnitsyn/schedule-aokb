<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        $items = $items->chunk(14, function ($items) {
            return $items;
        });
        return response()->json([
            'schedule' => $items
        ]);
    }
}
