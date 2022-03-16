<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
			'name' => ['required', 'string', 'max:191'],
			'short' => ['nullable', 'string', 'max:20'],
			'meet_abbr' => ['nullable', 'string', 'max:5'],
			'SA' => ['nullable', 'integer', Rule::unique('teams', 'SA')->ignore($this->team['id'] ?? null)],
			'address' => ['nullable', 'max:191'],
			'country' => ['nullable', 'max:191'],
		];
    }
}
