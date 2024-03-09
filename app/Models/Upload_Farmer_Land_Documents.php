<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_Farmer_Land_Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'farmer_applications_id',
        'farmer_land_documents_path'
    ];
}
