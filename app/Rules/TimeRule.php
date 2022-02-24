<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // https://regex101.com/r/shgO0G/1
        return preg_match('/^((?:[0-5]\d):[0-5]\d.[0-9]\d$)/D', $value) && $value !== '00:00.00';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.time');
    }
}
