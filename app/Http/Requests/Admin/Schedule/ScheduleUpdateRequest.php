<?php

namespace App\Http\Requests\Admin\Schedule;

use App\Events\UpdatedScheduleItem;
use App\Models\ScheduleItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class ScheduleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric'],
            'doctor_name' => ['required', 'string'],
            'doctor_job' => ['required', 'string'],
            'room' => ['required', 'string'],
            'start_at' => ['required', 'numeric'],
            'end_at' => ['required', 'numeric'],
        ];
    }

    public function update()
    {
        $scheduleItem = ScheduleItem::where('id', $this->validated('id'));
        if (!$scheduleItem) {
            return Redirect::route('schedule');
        }

        $data = $this->validated();

        $data['start_at'] = Carbon::createFromTimestampMs($data['start_at'], config('app.timezone'))->toDateTimeString();
        $data['end_at'] = Carbon::createFromTimestampMs($data['end_at'], config('app.timezone'))->toDateTimeString();

        $hasUpdated = $scheduleItem->update($data);
        if ($hasUpdated) {
            broadcast(new UpdatedScheduleItem($scheduleItem->first()))->toOthers();
        }

        return Redirect::route('schedule');
    }
}
