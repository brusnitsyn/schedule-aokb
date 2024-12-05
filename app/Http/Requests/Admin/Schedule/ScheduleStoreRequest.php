<?php

namespace App\Http\Requests\Admin\Schedule;

use App\Events\CreatedScheduleItem;
use App\Models\ScheduleItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ScheduleStoreRequest extends FormRequest
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
            'doctor_name' => ['required', 'string'],
            'doctor_job' => ['required', 'string'],
            'room' => ['required', 'string'],
            'start_at' => ['required', 'numeric'],
            'end_at' => ['required', 'numeric'],
            'status_schedule_item_id' => ['required', 'numeric']
        ];
    }

    public function store()
    {
        $hasCreated = ScheduleItem::create($this->validated());
        if ($hasCreated) {
            broadcast(new CreatedScheduleItem($hasCreated->load('statusScheduleItem')));
        }

        return Redirect::route('schedule');
    }
}
