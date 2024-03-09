<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Data_of_Applications extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_of_applicant',
        'husband_fathers_name',
        'email_id',
        'phone_number',
        'ration_card_number',
        'gender'
    ];
}
