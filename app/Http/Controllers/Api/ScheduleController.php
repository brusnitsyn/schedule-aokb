<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        $chunks = [];
        $tempArray = [];

        if (count($items) <= 14) {
            $chunks[] = $items;
        } else {
            foreach ($items as $item) {
                if (count($tempArray) === 14) {
                    $chunks[] = $tempArray;
                    $tempArray = [];
                }

                $tempArray[] = $item;
            }
        }

        return response()->json([
            'schedule' => $chunks
        ]);
    }
}
