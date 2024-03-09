<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tripura extends Model
{
    use HasFactory;

    protected $table = 'tripura';

    protected $fillable = [
        'id',
        'district',
        'subdivision',
        'ulb',
        'ward'
    ];
}
