<?php

namespace Database\Seeders;

use App\Models\ScheduleItem;
use App\Models\StatusScheduleItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StatusScheduleItem::create([
            'label' => 'Ведет приём',
            'value' => ''
        ]);
        StatusScheduleItem::create([
            'label' => 'Нет приёма',
            'value' => 'Нет приёма'
        ]);

        $start = Carbon::now()->setHours(8);
        ScheduleItem::create([
            'doctor_job' => 'Заведующая поликлиникой',
            'doctor_name' => 'Бырдина Е.Е.',
            'room' => '414',
            'start_at' => $start,
            'end_at' => $start->addHours(5),
            'status_schedule_item_id' => 1
        ]);
    }
}
