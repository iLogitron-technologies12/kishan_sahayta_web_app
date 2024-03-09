<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('farmer_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->bigInteger('user_id');
            $table->string('name_of_applicant');
            $table->string('husband_fathers_name')->nullable();
            $table->string('email_id')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->bigInteger('ration_no')->unique();
            $table->string('gender')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_division')->nullable();
            $table->string('block')->nullable();
            $table->string('revenue_circle')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('mouja')->nullable();
            $table->string('type_of_land_indentification_no')->nullable();
            $table->string('land_indentification_no')->nullable();
            $table->longText('complete_address')->nullable();
            $table->string('ttaadc_area')->nullable();
            $table->string('farming_area_in_acre')->nullable();
            $table->string('farming_area_in_hectare')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('confirm_account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('land_type')->nullable();
            $table->longText('ration_card_image_path')->nullable();
            $table->longText('any_supporting_land_document_path')->nullable();
            $table->bigInteger('status')->nullable()->default(0);
            $table->string('added_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_applications');
    }
};
