<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'facility_id',
        'room_type',
        'room_number',
        'room_rate',
        'room_capacity',
        'room_description',
        'room_amenities',
        'room_inclusion',
        'room_photo1',
        'room_photo2',
        'room_photo3',
        'created_at',
        'updated_at'
    ];
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
