<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;
    protected $table = 'disbursements';

    protected $fillable = [
        'id',
        'application_id',
        'number_of_plants',
        'disbursed_area',
        'disbursed_center',
        'disbursed_by',
        'status',
        'disbursed_date',
    ];
}
