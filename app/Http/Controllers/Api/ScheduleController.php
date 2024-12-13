<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
//        $chunks = $items->chunk(14)->all();
//        if (!is_array($chunks[array_key_last($chunks)])) {
//            $arr[] = $chunks[array_key_last($chunks)];
//            unset($chunks[array_key_last($chunks)]);
//            $chunks[] = $arr;
//        }
        $chunks = [];
        $tempArray = [];
        foreach ($items as $item) {
            if (count($tempArray) === 14) {
                $chunks[] = $tempArray;
                $tempArray[] = [];
            }

            $tempArray[] = $item;
        }

        return response()->json([
            'schedule' => $chunks
        ]);
    }
}
