<?php

namespace App\Rules;

use App\Models\RegistrationFee;
use Illuminate\Contracts\Validation\Rule;

class RegFeeRule implements Rule
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
        $regfee = RegistrationFee::first();
        return $value >= $regfee->amount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Amount must be greater than or equal to registration fee.';
    }
}
