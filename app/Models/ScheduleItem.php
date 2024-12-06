<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ScheduleItem extends Model
{
    public static $snakeAttributes = false;

    protected $appends = [
        'doctor_fio'
    ];

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

    public function getDoctorFioAttribute(): string
    {
        $fio = explode(" ", $this->doctor_name);
        $firstName = $fio[0];
        $middleName = count($fio) > 1 ? Str::substr($fio[1], 0, 1) : '';
        $lastName = count($fio) > 2 ? Str::substr($fio[2], 0, 1) : '';
        return "$firstName $middleName. $lastName.";
    }

    public function statusScheduleItem() {
        return $this->belongsTo(StatusScheduleItem::class);
    }
}
