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
        // Création de la table users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 100)->nullable();
            $table->string('firstname', 100);
            $table->string('password', 255);
            $table->string('pseudo', 100)->unique();
            $table->tinyInteger('role')->default(1)->comment('0 = admin, 1 = user');
            $table->tinyInteger('status')->default(1)->comment('0 = inactive, 1 = active');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Ajout de la colonne
            $table->rememberToken(); // Pour la fonctionnalité "Se souvenir de moi"
            $table->timestamps();
        });

        // Création de la table password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Création de la table sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};