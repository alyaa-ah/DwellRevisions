<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouseBooking extends Model
{
    use HasFactory;
    protected $table = 'guest_house_bookings';
    protected $fillable = [
            'client_id',
            'room_id',
            'fullname',
            'position',
            'agency',
            'contact',
            'address',
            'email',
            'activity',
            'GH_number',
            'GH_date',
            'room_number',
            'number_of_days',
            'number_of_nights',
            'check_in_date',
            'check_out_date',
            'arrival',
            'departure',
            'status',
            'total_lodgers',
            'rate',
            'total_amount',
            'num_of_male',
            'num_of_female',
            'male_guest',
            'special_request',
            'female_guest',
            'videoke_rent',
            'additional_bedding',
            'reason',
            'or_number',
            'created_at',
            'updated_at'
    ];
}
