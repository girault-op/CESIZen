<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprime la contrainte existante avant de modifier la colonne
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            // Ajoute la colonne avec la nouvelle valeur par défaut
            $table->tinyInteger('status')->default(1)->after('id'); // 1 = active
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprime la colonne avant de la recréer
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            // Recrée la colonne avec la valeur par défaut précédente
            $table->tinyInteger('status')->default(0)->after('id'); // 0 = inactive
        });
    }
};