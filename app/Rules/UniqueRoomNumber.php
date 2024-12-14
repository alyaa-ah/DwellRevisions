<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Room;
class UniqueRoomNumber implements ValidationRule
{
    protected $facilityId;

    public function __construct($facilityId)
    {
        $this->facilityId = $facilityId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the room number is unique within the facility
        $exists = Room::where('facility_id', $this->facilityId)
                      ->where('room_number', $value)
                      ->exists();
        if ($exists) {
            $fail('The room number must be unique within the facility.');
        }
    }
}
