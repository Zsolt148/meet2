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
        return [
            'is_final'  => ['nullable'],
            'is_paid'   => ['nullable'],
            'time'      => ['required', new TimeRule],
        ];
    }
}
