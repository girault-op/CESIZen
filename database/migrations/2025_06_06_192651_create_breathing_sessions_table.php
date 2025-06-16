<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breathing_sessions', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('breathing_mode_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table breathing_modes
            $table->timestamp('started_at'); // Date et heure de début de la session
            $table->timestamp('ended_at')->nullable(); // Date et heure de fin de la session (nullable)
            $table->integer('duration')->nullable(); // Durée de la session en secondes (nullable)
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breathing_sessions');
    }
};