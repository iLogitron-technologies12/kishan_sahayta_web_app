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
        Schema::create('training_batches', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->string('training_under')->nullable();
            $table->string('applicant_batch_name')->nullable();
            $table->string('training_start_date')->nullable();
            $table->string('training_end_date')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /***
        Reverse the migrations.
    ***/
    public function down(): void
    {
        Schema::dropIfExists('training_batches');
    }
};
