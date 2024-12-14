<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DftcBooking extends Model
{
    use HasFactory;
    protected $table = 'dftc_bookings';
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
            'DFTC_number',
            'DFTC_date',
            'room_number',
            'number_of_days',
            'number_of_nights',
            'check_in_date',
            'check_out_date',
            'arrival',
            'departure',
            'status',
            'rate',
            'total_amount',
            'num_of_male',
            'num_of_female',
            'janitor_services',
            'av_services',
            'special_request',
            'total_lodgers',
            'reason',
            'created_at',
            'updated_at'
    ];
}
