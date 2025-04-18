<?php

namespace App\Http\Requests\Admin\Schedule;

use App\Events\UpdatedScheduleItem;
use App\Models\ScheduleItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
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
            'start_at' => ['required'],
            'end_at' => ['required'],
            'status_schedule_item_id' => ['required', 'numeric']
        ];
    }

    public function update(ScheduleItem $scheduleItem)
    {
        $data = $this->validated();

        Log::info($scheduleItem);

        if (intval($data['start_at'])) $data['start_at'] = Carbon::createFromTimestampMs($data['start_at'], config('app.timezone'))->toDateTime();
        if (intval($data['end_at'])) $data['end_at'] = Carbon::createFromTimestampMs($data['end_at'], config('app.timezone'))->toDateTime();

        $hasUpdated = $scheduleItem->update($data);
        if ($hasUpdated) {
            broadcast(new UpdatedScheduleItem($scheduleItem));
        }

        return response()->json(['success' => true]);
    }
}
