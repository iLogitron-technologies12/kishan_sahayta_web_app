<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AclRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'role',
        'district',
        'sub_division',
    ];
}
