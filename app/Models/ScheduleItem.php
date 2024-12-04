<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    protected function startAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value, config('app.timezone'))->getTimestampMs(),
            set: fn (float|int|string $value) => Carbon::createFromTimestampMs($value, config('app.timezone'))->toDateTimeString(),
        );
    }

    protected function endAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value, config('app.timezone'))->getTimestampMs(),
            set: fn (float|int|string $value) => Carbon::createFromTimestampMs($value, config('app.timezone'))->toDateTimeString(),
        );
    }

    public function statusScheduleItem() {
        return $this->belongsTo(StatusScheduleItem::class);
    }
}
