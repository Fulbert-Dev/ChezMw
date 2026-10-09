<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logements', function (Blueprint $table) {

            $table->id();

            // Bailleur propriétaire de l'annonce
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Informations principales
            $table->string('titre');

            $table->enum('type_logement', [
                'appartement',
                'maison',
                'villa',
                'studio',
                'chambre',
                'chambre_salon',
            ]);

            // Caractéristiques
            $table->boolean('wc_douche_interne')->default(false);
            $table->boolean('cuisine')->default(false);

            $table->unsignedInteger('nombre_chambres')->nullable();
            $table->unsignedInteger('nombre_salles_bain')->nullable();

            // Localisation
            $table->string('ville')->default('Lomé');
            $table->string('quartier');
            $table->string('adresse')->nullable();

            // Prix
            $table->decimal('prix', 12, 2);

            // Description
            $table->text('description')->nullable();

            // Statut de l'annonce
            $table->enum('statut', [
                'brouillon',
                'actif',
                'loue',
                'archive',
            ])->default('brouillon');

            // Statistiques
            $table->unsignedInteger('vues')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logements');
    }
};
