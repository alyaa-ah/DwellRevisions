<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GuestsRequireFemale implements ValidationRule
{
    protected $numOfFemale;

    public function __construct($numOfFemale)
    {
        $this->numOfFemale = $numOfFemale;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->numOfFemale > 0 && empty($value)) {
            $fail('The female guests field is required when there are female guests.');
        }
    }
}
