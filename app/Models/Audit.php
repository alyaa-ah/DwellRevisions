<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $table = 'audits';
    protected $fillable = [
        'user_id',
        'fullname',
        'activity',
        'role',
        'created_at',
        'updated_at',
    ];
}
