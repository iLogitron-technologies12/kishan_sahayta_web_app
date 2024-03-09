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
        Schema::create('temp__data_of__applications', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_applicant')->nullable();
            $table->string('husband_fathers_name')->nullable();
            $table->string('email_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ration_card_number')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp__data_of__applications');
    }
};
