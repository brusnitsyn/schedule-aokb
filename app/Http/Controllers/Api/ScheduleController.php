<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        $chunks = $items->chunk(14)->toArray();
        if (!is_array($chunks[array_key_last($chunks)])) $chunks[] = [$chunks[array_key_last($chunks)]];
        return response()->json([
            'schedule' => $chunks
        ]);
    }
}
