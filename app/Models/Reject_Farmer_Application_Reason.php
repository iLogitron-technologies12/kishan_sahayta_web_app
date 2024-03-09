<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reject_Farmer_Application_Reason extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'farmer_applications_id',
        'reason_for_rejection'
    ];
}
