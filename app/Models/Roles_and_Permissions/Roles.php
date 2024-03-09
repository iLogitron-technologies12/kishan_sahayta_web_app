<?php

namespace App\Models\Roles_and_Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'role'
    ];
}
