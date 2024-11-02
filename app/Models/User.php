<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory; // Add this line

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'birthDate',
        'profilePicture',
        'isSelfPay',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birthDate' => 'date',
        'isSelfPay' => 'boolean',
    ];
}