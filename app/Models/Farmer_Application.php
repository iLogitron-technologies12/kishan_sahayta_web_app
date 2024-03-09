<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer_Application extends Model
{
    use HasFactory;

    protected $table = 'farmer_applications';

    protected $fillable = [
        'id',
        'application_id',
        'user_id',
        'name_of_applicant',
        'husband_fathers_name',
        'email_id',
        'phone_number',
        'ration_no',
        'gender',
        'district',
        'sub_division',
        'block',
        'revenue_circle',
        'tehsil',
        'mouja',
        'type_of_land_indentification_no',
        'land_indentification_no',
        'complete_address',
        'ttaadc_area',
        'farming_area_in_acre',
        'farming_area_in_hectare',
        'land_type',
        'ration_card_image_path',
        'any_supporting_land_document_path',
        'pin_code',
        'bank_name',
        'beneficiary_name',
        'account_number',
        'confirm_account_number',
        'ifsc_code',
        'amount_in_rupees',
        'status',
        'added_by',
    ];
    
}
