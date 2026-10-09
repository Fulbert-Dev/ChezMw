<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Offre actuelle
            $table->string('offre')
                ->default('gratuit')
                ->after('account_type');

            // Date de début de l'abonnement
            $table->timestamp('abonnement_debut')
                ->nullable()
                ->after('offre');

            // Date de fin de l'abonnement
            $table->timestamp('abonnement_fin')
                ->nullable()
                ->after('abonnement_debut');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'offre',
                'abonnement_debut',
                'abonnement_fin',
            ]);

        });
    }
};
