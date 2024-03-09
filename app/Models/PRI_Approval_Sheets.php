<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRI_Approval_Sheets extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'farmer_applications_id',
        'pri_approval_sheet_path'
    ];
}
