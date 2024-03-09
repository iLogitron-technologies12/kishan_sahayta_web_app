<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone_Number_and_OTP extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'phone_number',
        'otp'
    ];
}
