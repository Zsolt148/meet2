<?php

namespace App\Http\Requests\Portal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntryRequest extends FormRequest
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
        // https://regex101.com/r/shgO0G/1
        return [
            'competitor_id' => ['required', Rule::exists('competitors', 'id')],
            'meet_event_id' => ['required', Rule::exists('meet_event', 'id')],
            'time' => ['required', 'regex:/^((?:[0-5]\d):[0-5]\d.[0-9]\d$)/D'],
        ];
    }
}
