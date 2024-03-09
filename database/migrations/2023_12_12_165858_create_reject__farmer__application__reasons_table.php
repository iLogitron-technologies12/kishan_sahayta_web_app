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
        Schema::create('reject__farmer__application__reasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmer_applications_id');
            $table->longText('reason_for_rejection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reject__farmer__application__reasons');
    }
};
