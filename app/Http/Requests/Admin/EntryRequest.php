<?php

namespace App\Http\Requests\Admin;

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
		$rules = [];

		if($this->input('competitor_id') !== 'other') {
			$rules['competitor_id'] = ['required', Rule::exists('competitors', 'id')];
		}else {
			$rules['competitor_id'] = ['required'];
		}

		$default = [
			'team_id' => ['required', Rule::exists('teams', 'id')],
			'competitor_name' => ['nullable', 'required_if:competitor_id,other', 'string', 'max:191'],
			'competitor_birth' => ['nullable', 'required_if:competitor_id,other', 'date_format:Y', 'max:191'],
			'competitor_sex' => ['nullable', 'required_if:competitor_id,other', Rule::in(['F', 'N'])],
			'entries' => ['required', 'array'],
			'entries.*.meet_event_id' => ['required', Rule::exists('meet_event', 'id')],
			'entries.*.time' => ['required', 'array', new TimeRule],
			'entries.*.is_final' => ['nullable'],
			'entries.*.is_paid' => ['nullable'],
		];

		return array_merge($rules, $default);
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
