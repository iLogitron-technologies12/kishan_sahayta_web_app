<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer_Land_Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'farmer_applications_id',
        'latitude',
        'longitude'
    ];

}
