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
        Schema::create('p_r_i__approval__sheets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmer_applications_id');
            $table->string('pri_approval_sheet_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_r_i__approval__sheets');
    }
};
