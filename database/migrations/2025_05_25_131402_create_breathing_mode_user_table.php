<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breathing_mode_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('breathing_mode_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table breathing_modes
            $table->integer('usage_count')->default(0); // Nombre d'utilisations
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breathing_mode_user');
    }
};