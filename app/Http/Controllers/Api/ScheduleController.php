<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = \App\Models\ScheduleItem::orderBy('room')->with('statusScheduleItem')->get();
        $chunks = collect();
        if (count($items) <= 12) {
            $chunks->push($items);
        } else {
            $tempArray = collect();
            $lastItem = $items->last();
            foreach ($items as $item) {
                if (count($tempArray) === 12) {
                    $chunks->push($tempArray);
                    $tempArray = collect();
                }

                $tempArray->push($item);

                if ($item === $lastItem) {
                    $chunks->push($tempArray);
                    $tempArray = collect();
                }
            }
        }

        return response()->json([
            'schedule' => $chunks
        ]);
    }
}
