<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('logements', function (Blueprint $table) {

            // Niveau de visibilité
            // 0 = Normal
            // 1 = Mise en avant
            // 2 = Tête des résultats

            $table->unsignedTinyInteger('niveau_visibilite')
                ->default(0)
                ->after('statut');

            // Date de début de la mise en avant
            $table->timestamp('date_debut_visibilite')
                ->nullable()
                ->after('niveau_visibilite');

            // Date de fin de la mise en avant
            $table->timestamp('date_fin_visibilite')
                ->nullable()
                ->after('date_debut_visibilite');
        });
    }

    public function down(): void
    {
        Schema::table('logements', function (Blueprint $table) {

            $table->dropColumn([
                'niveau_visibilite',
                'date_debut_visibilite',
                'date_fin_visibilite',
            ]);

        });
    }
};
