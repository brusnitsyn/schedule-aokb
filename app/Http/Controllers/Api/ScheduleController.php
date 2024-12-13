<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        $chunks = $items->chunk(14);
        $chunksArray = $chunks->toArray();
        return response()->json([
            'schedule' => $chunksArray
        ]);
    }
}
