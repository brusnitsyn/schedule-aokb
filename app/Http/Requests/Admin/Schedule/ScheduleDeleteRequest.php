<?php

namespace App\Http\Requests\Admin\Schedule;

use App\Models\ScheduleItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ScheduleDeleteRequest extends FormRequest
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
            'id' => 'required|integer|exists:schedule_items,id',
        ];
    }

    public function delete()
    {
        $id = $this->validated('id');
        $scheduleItem = ScheduleItem::where('id', $id)->first();

        $hasDeleted = $scheduleItem->delete();

        return Redirect::route('schedule.index');
    }
}
