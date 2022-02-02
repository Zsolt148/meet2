<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MeetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_visible' => ['nullable'],
            'is_entriable' => ['nullable'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'date' => ['required'],
            'deadline' => ['required'],
            'host' => ['required'],
            'type' => ['required'],
            'phases' => ['required', 'integer'],
            'location_id' => ['required', Rule::exists('locations', 'id')],
            'contact_id' => ['required', Rule::exists('contacts', 'id')],
            'files' => ['nullable', 'array'],
            'body' => ['nullable'],
            'race_info_id' => ['nullable'],
            'pre_startlist_id' => ['nullable'],
            'race_record_id' => ['nullable'],
            'time_schedule_id' => ['nullable'],
        ];
    }
}
