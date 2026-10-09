<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter les champs de visibilité
     */
    public function up(): void
    {
        Schema::table('logements', function (Blueprint $table) {

            // Date d'expiration de la visibilité
            $table->timestamp('visibilite_expire_le')
                ->nullable()
                ->after('niveau_visibilite');
        });
    }

    /**
     * Supprimer les champs de visibilité
     */
    public function down(): void
    {
        Schema::table('logements', function (Blueprint $table) {

            $table->dropColumn('visibilite_expire_le');

        });
    }
};
