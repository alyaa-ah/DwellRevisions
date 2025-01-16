<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffHouseBooking extends Model
{
    use HasFactory;
    protected $table ='staff_house_bookings';
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
        'SH_number',
        'SH_date',
        'total_lodgers',
        'room_number',
        'number_of_days',
        'number_of_nights',
        'check_in_date',
        'check_out_date',
        'arrival',
        'departure',
        'status',
        'rate',
        'payment',
        'total_amount',
        'num_of_male',
        'special_request',
        'num_of_female',
        'male_guest',
        'female_guest',
        'additional_bedding',
        'reason',
        'or_number',
        'created_at',
        'updated_at'
    ];
}
