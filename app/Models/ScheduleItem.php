<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    protected $fillable = [
        'doctor_job',
        'doctor_name',
        'room',
        'start_at',
        'end_at',
        'status_schedule_item_id'
    ];

    public function statusScheduleItem() {
        return $this->belongsTo(StatusScheduleItem::class);
    }
}
