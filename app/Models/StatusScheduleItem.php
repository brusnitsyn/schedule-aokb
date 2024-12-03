<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusScheduleItem extends Model
{
    protected $fillable = [
        'label',
        'value',
    ];
}
