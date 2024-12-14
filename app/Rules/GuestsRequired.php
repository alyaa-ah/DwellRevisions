<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GuestsRequired implements ValidationRule
{
    protected $numOfMale;

    public function __construct($numOfMale)
    {
        $this->numOfMale = $numOfMale;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    // Check if numOfMale is greater than 0 and maleGuests is empty
        if ($this->numOfMale > 0 && empty($value)) {
            $fail('The male guests field is required when there are male guests.');
        }
    }
}
