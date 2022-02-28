<?php

namespace App\Http\Requests\Portal;

use App\Rules\TimeRule;
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
        return [
            'competitor_id' => ['required', Rule::exists('competitors', 'id')],
            'entries' => ['required', 'array'],
            'entries.*.meet_event_id' => ['required', Rule::exists('meet_event', 'id')],
            'entries.*.time' => ['required', 'array', new TimeRule],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'entries.*.meet_event_id' => trans('validation.meet_event_id'),
        ];
    }
}
