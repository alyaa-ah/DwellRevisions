<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'fullname',
        'email',
        'position',
        'agency',
        'address',
        'contact',
        'username',
        'password',
        'role',
        'status',
        'created_at',
        'updated_at'
    ];
}
