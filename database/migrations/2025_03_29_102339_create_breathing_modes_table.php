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
        Schema::create('breathing_modes', function (Blueprint $table) {
            $table->id();
            $table->string('label'); 
            $table->integer('inspiration_time'); 
            $table->integer('apnea_time'); 
            $table->integer('exhalation_time'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breathing_modes');
    }
};
