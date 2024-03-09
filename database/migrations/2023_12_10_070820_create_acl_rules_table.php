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
        Schema::create('acl_rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('role');
            $table->string('district')->nullable();
            $table->string('sub_division')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acl_rules');
    }
};
